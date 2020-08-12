import { writable } from "svelte/store";
import Cookies from "js-cookie";
import dummySoal from "./dummy-data";

const store = () => {
  const state = dummySoal;

  const dataSoal = writable(state);

  const listNumber = writable([]);

  // get markedquestion from cookies
  let checkMarkedQuestion = Cookies.get("MARKEDQUESTION") || false;
  checkMarkedQuestion
    ? (checkMarkedQuestion = JSON.parse(Cookies.get("MARKEDQUESTION")))
    : false;
  let checkMarkedQuestionState = checkMarkedQuestion || [];
  let markQuestion = writable(checkMarkedQuestionState);

  const methods = {
    tandaiSoal(data) {
      checkMarkedQuestionState = [...checkMarkedQuestionState, data];
      Cookies.set("MARKEDQUESTION", JSON.stringify(checkMarkedQuestionState));
      localStorage.setItem(
        "MARKEDQUESTION",
        JSON.stringify(checkMarkedQuestionState)
      );
    },
    hapusTandaiSoal(data) {
      checkMarkedQuestionState = checkMarkedQuestionState.filter((marked) => {
        return marked.soal_no != data.soal_no;
      });
      Cookies.set("MARKEDQUESTION", JSON.stringify(checkMarkedQuestionState));
      localStorage.setItem(
        "MARKEDQUESTION",
        JSON.stringify(checkMarkedQuestionState)
      );
    },
    getListNumber() {
      dataSoal.subscribe((val) => {
        // get from Cookies
        let getTandaiSoal = Cookies.get("MARKEDQUESTION") || false;
        let getJawabanSoal = Cookies.get("TRYOUTANSWER") || false;
        let a = [];
        for (let i = 0; i < val.subtest.soal.length; i++) {
          let data = {
            no: i + 1,
            tandai_soal: false,
            terjawab: false,
          };
          if (getTandaiSoal) {
            JSON.parse(getTandaiSoal).map((asd) => {
              if (asd.soal_no == i + 1) {
                data = {
                  no: i + 1,
                  tandai_soal: true,
                  terjawab: false,
                };
              }
            });
          }

          if (getJawabanSoal) {
            JSON.parse(getJawabanSoal).map((aaa) => {
              if (aaa.soal_no == i + 1) {
                data.terjawab = true;
              }
            });
          }
          a.push(data);
        }
        listNumber.set(a);
        console.log(a);
      });
    },
  };

  return {
    dataSoal,
    markQuestion,
    listNumber,
    ...methods,
  };
};

export const soalStore = store();
