import { writable } from "svelte/store";
// Library
import {
  setEncryptCookie,
  setDecryptCookie,
} from "../../library/SetCryptoCookie";

const store = () => {
  let state = setDecryptCookie("TRYOUTANSWER", "object");
  const { subscribe, set, update } = writable(state);

  const methods = {
    createJawaban(data) {
      if (state.length == 0) {
        update((n) => (state = [...n, data]));
      } else {
        state.filter((curr, i) => {
          if (curr.soal_no == data.soal_no) {
            curr.option = data.option;
            state.splice(-1, 1);
            state = state;
          }
        });
        update((n) => (state = [...n, data]));
      }
      setEncryptCookie("TRYOUTANSWER", state);
    },
    hapusJawaban(no) {
      let a = state.filter((data) => data.soal_no != no);
      state = a;
      update((curState) => (curState = state));
      setEncryptCookie("TRYOUTANSWER", state);
    },
    kirimJawaban(userId, dataJawaban, dataSoal) {
      try {
        dataJawaban.forEach((jawaban) => {
          let jawab = "";
          dataSoal.forEach((soal) => {
            jawab = {
              siswa_iduser: userId,
              soal_no: jawaban.soal_no,
              answer: jawaban.option,
              soal_subtest_idsubtest: soal.subtest_idsubtest,
              soal_subtest_tryout_idtryout: soal.subtest_tryout_idtryout,
            };
          });
          this.reqJawaban(jawab);
        });
      } catch (err) {
        alert("Error, Please Try Again");
      }
    },
    async reqJawaban(data) {
      // Kirim jawaban ke API
      const reqApi = await fetch(
        `/tryout/siswa/answer`,
        {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(data),
        }
      );
    },
  };

  return {
    subscribe,
    set,
    update,
    ...methods,
  };
};

export const jawabanStore = store();
