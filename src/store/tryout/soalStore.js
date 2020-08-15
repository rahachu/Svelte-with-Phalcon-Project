import { writable } from "svelte/store";
import Cookies from "js-cookie";
// Library
import {
  setEncryptCookie,
  setDecryptCookie,
} from "../../library/SetCryptoCookie";

const store = () => {
  // LIST NUMBER STATE ===============================================
  let decryptSubtestId = setDecryptCookie("SUBTEST", "number");
  decryptSubtestId.length == 0 ? (decryptSubtestId = 0) : decryptSubtestId;
  let subtestId = writable(decryptSubtestId);
  // =================================================================

  // SOAL STATE =====================================================
  let state = setDecryptCookie("SOALDATA", "object");
  const dataSoal = writable(state);
  // =================================================================

  // LIST NUMBER STATE ===============================================
  const listNumber = writable([]);
  // =================================================================

  // MARKED SOAL STATE ===============================================
  let checkMarkedQuestionState = setDecryptCookie("MARKEDQUESTION", "object");
  let markQuestion = writable(checkMarkedQuestionState);
  // =================================================================

  // METHODS STATE
  const methods = {
    startTryOut(timeInMinute) {
      let today = new Date();

      let bulan = today.toLocaleString("default", { month: "short" });
      let tanggal = today.getDate();
      let tahun = today.getFullYear();
      let jam = today.getHours();
      let menit = today.getMinutes();
      let detik = today.getSeconds();

      let current = "";
      let setJam = "";
      let setDetik = "";

      setDetik = detik + 2;
      setJam = jam + timeInMinute;
      if (setJam > 24) {
        current = setJam - 24;
        setJam = 0 + current;
        tanggal += 1;
      }

      let countDown = `${bulan} ${tanggal}, ${tahun} ${setJam}:${menit}:${setDetik}`;
      setEncryptCookie("TRYOUTTIME", countDown);
      localStorage.setItem("no_soal", 1);
    },
    tandaiSoal(data) {
      checkMarkedQuestionState = [...checkMarkedQuestionState, data];
      setEncryptCookie("MARKEDQUESTION", checkMarkedQuestionState);
    },
    hapusTandaiSoal(data) {
      checkMarkedQuestionState = checkMarkedQuestionState.filter((marked) => {
        return marked.soal_no != data.soal_no;
      });
      setEncryptCookie("MARKEDQUESTION", checkMarkedQuestionState);
    },
    getListNumber() {
      dataSoal.subscribe((val) => {
        // get from Cookies
        let getTandaiSoal =
          setDecryptCookie("MARKEDQUESTION", "object") || false;
        let getJawabanSoal =
          setDecryptCookie("TRYOUTANSWER", "object") || false;
        let dataJawaban = [];
        let subtestNo = "";

        subtestId.subscribe((val) => (subtestNo = val));
        for (let i = 0; i < val.subtest[subtestNo].soal.length; i++) {
          let data = {
            no: i + 1,
            tandai_soal: false,
            terjawab: false,
          };
          if (getTandaiSoal) {
            getTandaiSoal.map((soal) => {
              if (soal.soal_no == i + 1) {
                data = {
                  no: i + 1,
                  tandai_soal: true,
                  terjawab: false,
                };
              }
            });
          }

          if (getJawabanSoal) {
            getJawabanSoal.map((jawaban) => {
              if (jawaban.soal_no == i + 1) {
                data.terjawab = true;
              }
            });
          }
          dataJawaban.push(data);
        }
        listNumber.set(dataJawaban);
      });
    },
    async getSoalApi() {
      const reqSoal = await fetch(
        `http://${window.location.host}/tryout/data/1`
      );
      const resSoal = await reqSoal.json();
      const tryout = resSoal;
      dataSoal.update((soal) => (soal = tryout));
      setEncryptCookie("SOALDATA", tryout);
    },
  };

  return {
    subtestId,
    dataSoal,
    markQuestion,
    listNumber,
    ...methods,
  };
};

export const soalStore = store();
