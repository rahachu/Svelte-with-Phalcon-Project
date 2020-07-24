import { writable } from "svelte/store";
import dummySoal from "./dummy-data";

const soal = writable(dummySoal);
const jawaban = writable([
  {
    soal_no: 1,
    jawaban: "A",
  },
]);

const soalStore = {
  dataSoal: soal.subscribe,
};

const jawabanStore = {
  dataJawaban: jawaban.subscribe,
  createJawaban: (data) => {
    console.log(data);
  },
};

export { soalStore, jawabanStore };
