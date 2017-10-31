<template>

  <v-app light v-cloak>
    <v-navigation-drawer app temporary enable-resize-watcher clipped v-model="menu">

      <v-toolbar flat>
        <v-list>
          <v-list-tile>
            <v-list-tile-title class="title">
              Quck Links
            </v-list-tile-title>
          </v-list-tile>
        </v-list>
      </v-toolbar>
      <v-divider></v-divider>

      <v-list dense class="pt-0">

        <v-list-tile to="/">

          <v-list-tile-action>
            <v-icon>home</v-icon>
          </v-list-tile-action>

          <v-list-tile-content>

            <v-list-tile-title> Dashboard </v-list-tile-title>

          </v-list-tile-content>

        </v-list-tile>

        <v-list-tile to="/settings">

          <v-list-tile-action>
            <v-icon>settings</v-icon>
          </v-list-tile-action>

          <v-list-tile-content>

            <v-list-tile-title> Settings </v-list-tile-title>

          </v-list-tile-content>

        </v-list-tile>

        <v-list-tile href="/bands">

          <v-list-tile-action>
            <v-icon>music_note</v-icon>
          </v-list-tile-action>

          <v-list-tile-content>

            <v-list-tile-title> See All Bands </v-list-tile-title>

          </v-list-tile-content>

        </v-list-tile>

        <v-list-tile href="/venues">

          <v-list-tile-action>
            <v-icon>store</v-icon>
          </v-list-tile-action>

          <v-list-tile-content>

            <v-list-tile-title> See All Venues </v-list-tile-title>

          </v-list-tile-content>

        </v-list-tile>

        <v-list-tile href="/tours">

          <v-list-tile-action>
            <v-icon>directions_car</v-icon>
          </v-list-tile-action>

          <v-list-tile-content>

            <v-list-tile-title> Check Out Upcoming Tours </v-list-tile-title>

          </v-list-tile-content>

        </v-list-tile>

      </v-list>

    </v-navigation-drawer>
    <v-toolbar app> 

      <v-toolbar-side-icon title="Open the main menu." @click="showMenu"></v-toolbar-side-icon>

      <v-toolbar-title class="dark--text"><small>Hey, {{user.name}}!</small></v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn to="/profile/add" icon title="See your pages.">
        <v-icon>apps</v-icon>
      </v-btn>



      <v-menu>        
        <v-avatar v-if="!image" size="36px" slot="activator">
          <img :src="'/storage/'+ user.avatar" :alt="user.name">
        </v-avatar>

        <v-avatar v-if="image" size="36px" slot="activator">
          <img :src="image" :alt="user.name">
        </v-avatar>

        <v-list>

          <v-list-tile>
            <form id="image-form" action="/change-avatar" method="PUT" enctype="multipart/form-data">
              <input name="avatar" type="file" @change="onFileChange" id="image">
            </form> 


          </v-list-tile>

        </v-list>
      </v-menu>      

      <v-menu>        
        <v-btn icon title="More options" slot="activator">
          <v-icon>more_vert</v-icon>
        </v-btn>
        <v-list>

          <v-list-tile>
            <v-btn href="/" class="green--text" flat>Front Page</v-btn>
          </v-list-tile>

          <v-list-tile>
            <v-btn @click="logout" class="red--text darken-2" flat>Logout</v-btn>
          </v-list-tile>

        </v-list>
      </v-menu>

    </v-toolbar>
    <main>
      <v-content>
        <v-container fluid>   
          <transition name="fade">
            <router-view></router-view>
          </transition>
        </v-container>
      </v-content>
    </main>
    <v-footer app></v-footer>
    <form action="/logout" method="post" id="log-out"></form>
  </v-app>

</template>

<script>
export default{
  data(){
    return {
      token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      more: false,
      user: '',
      menu: false,
      avatarPreview: '',
      image: ''
    }
  },
  computed: {
    avatar: function(){
      return 
    }
  },
  methods: {
    showMenu: function(){
      this.menu = true;
    },
    logout: function(){
      document.getElementById('log-out').submit()
    },
    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length)
        return;
      this.createImage(files[0]);

      var data = new FormData();
      data.append('avatar', document.getElementById('image').files[0]);
      data.append('_token', this.token);
      data.append('_method', 'put');

      var config = {
        headers: {'Content-Type': 'multipart/FormData'}
      };

      axios.post('/api/change-avatar', data, config);

    },
    createImage(file) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  },
  mounted(){
    axios.get('/api/user').then(response => this.user = response.data);
  }
}
</script>

<style>
.list_tile{
  background-color: grey;
  cursor: pointer;
}

#log-out{
  display: none;
}
</style>