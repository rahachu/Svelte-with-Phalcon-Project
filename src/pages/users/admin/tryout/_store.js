import { writable } from 'svelte/store';

let TOdata = null

export const dataTO = writable(TOdata);