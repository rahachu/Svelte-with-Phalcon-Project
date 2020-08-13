import { writable } from "svelte/store";

function getAuthInfo() {
    return fetch(`http://${window.location.host}/auth`).then(res=>res.json())
}

function createAuth() {
    const { subscribe,set,update } = writable({login: "wait"});
    getAuthInfo().then((auth)=>{
        set(auth);
    })

    return {
        subscribe,
        refresh: () => {
            getAuthInfo().then((auth)=>{
                set(auth);
            })
        }
    }
}

export const auth = createAuth();