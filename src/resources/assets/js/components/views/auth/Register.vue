<template>
  <div class="form-auth-wrap d-flex align-items-center justify-content-center">
    <form class="form-auth form-auth-md" @submit.prevent="register" @keydown="form.onKeydown($event)">

      <!-- Header -->
      <h2 class="form-auth-header">Register</h2>

      <!-- Name -->
      <div class="form-group">
        <label for="inputName" class="sr-only">Nomor UN</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-user-circle" aria-hidden="true"></i></div>
          </div>
          <input v-model="form.name" type="text" name="name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" id="inputName" placeholder="Nomor UN" autofocus>
          <has-error :form="form" field="name"/>
        </div>
      </div><!-- /.form-group -->

      <!-- Nomor KK -->
      <div class="form-group">
        <label for="inputNomorKK" class="sr-only">Nomor KK</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-user-circle" aria-hidden="true"></i></div>
          </div>
          <input v-model="form.nomor_kk" type="text" name="nomor_kk" class="form-control" :class="{ 'is-invalid': form.errors.has('nomor_kk') }" id="inputNomorKK" placeholder="Nomor KK" autofocus>
          <has-error :form="form" field="nomor_kk"/>
        </div>
      </div><!-- /.form-group -->

      <!-- Tanggal lahir -->
      <div class="form-group">
        <label for="inputTglLahir" class="sr-only">Tanggal Lahir</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
          </div>
          <input v-model="form.tgl_lahir" type="tgl_lahir" name="tgl_lahir" class="form-control" :class="{ 'is-invalid': form.errors.has('tgl_lahir') }" id="inputTglLahir" placeholder="Tanggal Lahir : contoh ( 010295 ) tgl-bln-thn">
          <has-error :form="form" field="tgl_lahir"/>
        </div>
      </div><!-- /.form-group -->

      <!-- Password -->
      <div class="form-group">
        <label for="inputPassword" class="sr-only">Password</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></div>
          </div>
          <input v-model="form.password" type="password" name="password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" id="inputPassword" placeholder="Password">
          <has-error :form="form" field="password"/>
        </div>
      </div><!-- /.form-group -->

      <!-- Password Confirmation -->
      <div class="form-group">
        <label for="inputPasswordConfirm" class="sr-only">Confirm Password</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></div>
          </div>
          <input v-model="form.password_confirmation" type="password" name="password_confirmation" class="form-control" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" id="inputPasswordConfirm" placeholder="Confirm Password">
          <has-error :form="form" field="password_confirmation"/>
        </div>
      </div><!-- /.form-group -->

      <!-- Submit -->
      <button :disabled="form.busy" type="submit" class="btn btn-primary btn-block text-capitalize">Register</button>

      <!-- Footer -->
      <div class="form-auth-footer d-flex flex-wrap flex-column">
        <div class="btn-group">
          <router-link class="btn btn-light w-100 text-capitalize" :to="{ name: 'login' }" exact>
            Log In
          </router-link>
          <router-link class="btn btn-light w-100 text-capitalize" :to="{ name: 'home' }" exact>
            Back to home
          </router-link>
        </div>
      </div>

    </form>
  </div>
</template>

<script>
import swal from 'sweetalert2';

export default {
  data: () => ({
    form: new Form({
      name: '',
      tgl_lahir: '',
      password: '',
      password_confirmation: ''
    })
  }),

  methods: {
    async register () {
      //console.log(this.form.errors);
      // Register the user.
      const { data } = await this.form.post('/api/register')

      if(data.nomor_un){
        swal({
          type: 'error',
          title: 'Kesalahan pendaftaran.',
          text: data.nomor_un,
          reverseButtons: true,
          confirmButtonText: 'Ok',
          cancelButtonText: 'Cancel'
        })

        return false;
      }

      // Log in the user.
      const { data: { token }} = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('saveToken', { token })

      // Update the user.
      await this.$store.dispatch('updateUser', { user: data })

      // Fetch the user
      await this.$store.dispatch('fetchUser', { user: data })

      // Redirect home.
      console.log(data);
      this.$router.push({ name: data.redirect })
    }
  }
}
</script>
