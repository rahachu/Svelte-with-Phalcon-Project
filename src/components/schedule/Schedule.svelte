<script>
  import { url } from "@sveltech/routify";
  import { onMount } from "svelte";
  import { scheduleStore } from "../../store/schedule.js";
  import Loader from "../Loader.svelte";
  import FullCalendar, { Draggable } from "svelte-fullcalendar";
  import dayGridPlugin from "@fullcalendar/daygrid";
  import timeGridPlugin from "@fullcalendar/timegrid";
  import idLocale from "@fullcalendar/core/locales/id";
  import interactionPlugin from "@fullcalendar/interaction"; // needed for dateClick

  let dataDetail = "";
  let isLoading = true;
  let activeModal = false;

  let options = {
    timeZone: "local",
    locale: idLocale,
    // dateClick: handleDateClick,
    droppable: false,
    editable: false,
    events: [],
    initialView: "dayGridMonth",
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    headerToolbar: {
      left: "title",
      right: "prev,today,next"
    },
    footerToolbar: {
      center: "dayGridMonth,timeGridWeek,timeGridDay"
    },
    titleFormat: { year: "numeric", month: "short", day: "numeric" },
    weekends: true,
    eventColor: "#fff",
    eventBackgroundColor: "#fd7d00",
    height: "auto",
    eventClick: function(info) {
      console.error(info);
      info.jsEvent.preventDefault();
      dataDetail = info.event;
      activeModal = true;
    }
  };

  onMount(() => {
    scheduleStore.loadJadwal().then(() => {
      scheduleStore.subscribe(data => {
        options.events = data;
        isLoading = false;
      });
    });
  });

  let calendarComponentRef;

  $: console.log(dataDetail);
</script>

<style>
  .app {
    width: 100%;
    height: 100%;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  .app-calendar {
    margin: 0;
  }

  .modal-card-body-description {
    list-style: none;
    color: var(--blue-color);
    font-weight: 600;
  }
</style>

<div class="app">

  {#if isLoading}
    <Loader title="Memuat Jadwal" />
  {:else}
    <div class="app-calendar">
      <FullCalendar bind:this={calendarComponentRef} {options} />
    </div>
  {/if}

</div>
{#if activeModal}
  <div class="modal" class:is-active={activeModal}>
    <div class="modal-background" />
    <div class="modal-card p-4">
      <header class="modal-card-head">
        <p class="modal-card-title title is-4">Detail Jadwal</p>
        <button
          class="delete"
          aria-label="close"
          on:click={() => (activeModal = !activeModal)} />
      </header>
      <section class="modal-card-body">
        <div class="title is-4">{dataDetail.title}</div>
        <ul class="modal-card-body-description mb-4">
          <li>
            <span>
              <i class="far fa-calendar-alt" />
            </span>
            Mulai pada : {`${dataDetail.startStr.split('T')[0]} ${dataDetail.startStr.split('T')[1].split('+')[0]}`}
          </li>
          <li>
            <span>
              <i class="far fa-calendar-alt" />
            </span>
            Berakhir pada : {`${dataDetail.endStr.split('T')[0]} ${dataDetail.endStr.split('T')[1].split('+')[0]}`}
          </li>
        </ul>
        <div class="mb-4">
          <p>{dataDetail.id}</p>
        </div>
        <a href={$url(dataDetail.url)} target="_blank">
          <button class="button is-primary">
            <i class="fas fa-external-link-alt" />
            Menuju Link
          </button>
        </a>
      </section>
    </div>
  </div>
{/if}
