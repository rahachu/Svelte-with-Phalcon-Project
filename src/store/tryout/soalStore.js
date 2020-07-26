import { writable } from "svelte/store";
import dummySoal from "./dummy-data";

const store = () => {
  const state = dummySoal;

  const { subscribe, set, update } = writable(state);

  const methods = {};

  return {
    subscribe,
    set,
    update,
    ...methods,
  };
};

export const soalStore = store();
