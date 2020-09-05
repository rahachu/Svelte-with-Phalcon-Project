<script>
  import Cookies from "js-cookie";
  import { onMount } from "svelte";
  import { goto } from "@sveltech/routify";
  import {
    setEncryptCookie,
    setDecryptCookie
  } from "../../library/SetCryptoCookie";
  import { soalStore } from "../../store/tryout/soalStore";
  import { jawabanStore } from "../../store/tryout/jawabanStore";
  import { auth } from "../../store/auth";

  let subtestId = setDecryptCookie("SUBTEST", "number");
  let dataSoal, userId, dataJawaban;

  onMount(() => {
    let checkTryoutTime = Cookies.get("TRYOUTTIME") || false;
    if (checkTryoutTime === false) {
      $goto("/tryout");
    }
  });

  // get auth
  auth.subscribe(user => {
    userId = user.id;
  });

  // get data soal dari soal store
  soalStore.dataSoal.subscribe(val => {
    dataSoal = val.subtest[subtestId].soal;
  });

  // get data jawaban dari jawaban store
  jawabanStore.subscribe(val => (dataJawaban = val));

  $: data = "";

  let countDown = new Date(`${getCookie("TRYOUTTIME")}`);

  let startTime = setInterval(function() {
    let now = new Date().getTime();
    let distance = countDown - now;

    let hours = Math.floor(
      (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    data = `${hours}Jam : ${minutes}Menit : ${seconds}s`;

    if (distance < 0) {
      clearInterval(startTime);
      // Kirim Jawaban
      jawabanStore.kirimJawaban(userId, dataJawaban, dataSoal);
      jawabanStore.set([]);

      data = "WAKTU HABIS";
      setEncryptCookie("SELESAI", true);
      Cookies.remove("IDTRYOUT");
      Cookies.remove("SUBTEST");
      Cookies.remove("TRYOUTTIME");
      localStorage.removeItem("DATASOAL");
      localStorage.removeItem("no_soal");
      $goto("/tryout/selesai-tryout");
    }
  }, 1000);

  function getCookie(name) {
    let decryptCookie = setDecryptCookie(name, "number");
    return decryptCookie;
  }
</script>

<p>{data}</p>
