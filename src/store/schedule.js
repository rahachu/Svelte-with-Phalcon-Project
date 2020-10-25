import { writable } from "svelte/store"

const store = () => {
  const { subscribe, set, update } = writable([])

  const methods = {
    async loadJadwal() {
      const reqApi = await fetch('/dashboard/tryoutsaya')
      const resApi = await reqApi.json();
      const events = []

      await resApi.map((data) => {
        const event = {
          title: data.name,
          start: `${data.start_time}`,
          end: `${data.end_time}`,
          url: `/users/siswa/tryout`,
          id: data.description
        }
        events.push(event)
      })

      await set(events)
      return resApi;
    }
  }

  return {
    subscribe,
    set,
    update,
    ...methods,
  }
}

export const scheduleStore = store()
