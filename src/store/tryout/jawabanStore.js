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
      localStorage.setItem("A", JSON.stringify(state));
      // Cookies.set("TRYOUTANSWER", JSON.stringify(state));
      setEncryptCookie("TRYOUTANSWER", state);
    },
    hapusJawaban(no) {
      let a = state.filter((data) => data.soal_no != no);
      state = a;
      update((curState) => (curState = state));
      localStorage.setItem("A", JSON.stringify(state));
      // Cookies.set("TRYOUTANSWER", JSON.stringify(state));
      setEncryptCookie("TRYOUTANSWER", state);
    },
    async kirimJawaban(data) {
      try {
        data.forEach((jawaban) => {
          console.log("berhasil");
        });
        return true;
      } catch (err) {
        console.log(err);
      }
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
