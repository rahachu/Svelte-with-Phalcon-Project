<script>
import {get,post} from "../../library/csrfFetch.js"
import { goto } from "@sveltech/routify"
import { NotificationDisplay, notifier } from '@beyonk/svelte-notifications'

let userRegistration = {
  fullname:'',
  school:'',
  city:'',
  phone:'',
  username:'',
  email:'',
  password:''
}

let isLoading = false;


function handleSubmit(e){
  e.preventDefault();
  isLoading = true
  registrationProcess();
}

function registrationProcess(){
    post('/register', userRegistration)
    .then(res=>res.json())
    .then((res)=>{
      isLoading = false;
      if (res.error) {
        let i = 0;
        res.error.forEach(msg => {
          setTimeout(()=>notifier.danger(msg),i*250);
          i++;
        });
      }
      if (res.message) {
        notifier.success(res.message);
      }
    })
}

</script>

<style>
  .registration{
    display: flex;
    justify-content: center;
    margin-top: 10%;
  }

  .form-group{
    text-align: left;
  }
</style>

<NotificationDisplay />

<div class="registration">

  <form on:submit={handleSubmit} method="POST">
    <div class="form-group">
      <label for="fullname">Fullname</label>
      <input bind:value={userRegistration.fullname} type="text" autocomplete="off" name="fullname" id="fullname">
    </div>

    <div class="form-group">
      <label for="school">School</label>
      <input bind:value={userRegistration.school} type="text" autocomplete="off" name="school" id="school">
    </div>
  
    <div class="form-group">
      <label for="city">City</label>
      <input bind:value={userRegistration.city} type="text" autocomplete="off" name="city" id="city">
    </div>

    <div class="form-group">
      <label for="phone">Phone</label>
      <input bind:value={userRegistration.phone} type="tel" autocomplete="off" name="phone" id="phone">
    </div>

    <div class="form-group">
      <label for="username">Username</label>
      <input bind:value={userRegistration.username} type="text" autocomplete="off" name="username" id="username">
    </div>
    
    <div class="form-group">
      <label for="email">Email</label>
      <input bind:value={userRegistration.email} type="email" autocomplete="off" name="email" id="email">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input bind:value={userRegistration.password} type="password" name="password" id="password">
    </div>

    <div class="form-group">
      <button type="submit">
          {#if isLoading}
           Loading
          {:else}
            Registrasi
          {/if}
      </button>
    </div>
  </form>
</div>