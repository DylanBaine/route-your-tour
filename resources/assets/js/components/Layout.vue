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

        <v-list-tile to="/home">

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

    <v-toolbar-title class="dark--text">Welcome, {{user}}!</v-toolbar-title>

    <v-spacer></v-spacer>

    <v-btn to="/home/profiles" icon title="See your pages.">
      <v-icon>apps</v-icon>
    </v-btn>

    <v-avatar size="36px">
      <img src="https://avatars0.githubusercontent.com/u/9064066?v=4&s=460" alt="">
    </v-avatar>

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
              <div v-show="loading" @loaded="loading = false" style="display: flex; justify-content: center; align-items: center; height: 80vh;">
                <v-progress-circular indeterminate color="primary"></v-progress-circular>
              </div>
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
        more: false,
        user: '',
        menu: false
      }
    },
    methods: {
      showMenu: function(){
        this.menu = true;
      },
      logout: function(){
        document.getElementById('log-out').submit()
      }
    },
    mounted(){
      axios.get('/api/user').then(response => this.user = response.data.name);
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