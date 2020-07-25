import { writable } from 'svelte/store';

let TOdata = {
    name: "Judul Tryout",
    subtest: []
}

export const dataTO = writable(TOdata);