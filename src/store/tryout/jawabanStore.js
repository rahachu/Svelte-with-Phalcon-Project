import Cookies from "js-cookie";
import { writable } from "svelte/store";

const jawaban = () => {
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
            // state = state.splice(-1, 1);
            // state.splice(i, 1);
            // update((n) => {
            //   state = state;
            //   [...n, data];
            // });
            curr.option = data.option;
            state.splice(-1, 1);
            state = state;
          }
        });
        update((n) => (state = [...n, data]));
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

export const jawabanStore = jawaban();
