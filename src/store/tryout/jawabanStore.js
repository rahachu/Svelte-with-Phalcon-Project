import Cookies from "js-cookie";
import { writable } from "svelte/store";

const store = () => {
  let checkCookie = Cookies.get("TRYOUTANSWER") || false;
  checkCookie ? (checkCookie = JSON.parse(Cookies.get("TRYOUTANSWER"))) : false;
  let state = checkCookie || [];

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
      Cookies.set("TRYOUTANSWER", JSON.stringify(state));
    },
    hapusJawaban(no) {
      let a = state.filter((data) => data.soal_no != no);
      state = a;
      update((curState) => (curState = state));
      localStorage.setItem("A", JSON.stringify(state));
      Cookies.set("TRYOUTANSWER", JSON.stringify(state));
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
