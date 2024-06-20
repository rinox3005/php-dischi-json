const { createApp } = Vue;

createApp({
  data() {
    return {
      urlAPI: "http://localhost/php-dischi-json/server/server.php",
      musicDiscs: [],
      infoResults: {},
      showInfo: false,
    };
  },
  methods: {
    // funzione che fa la chiamata axios e si aspetta un parametro id per le info della modale, se il parametro non c'é fa la chiamata classica
    getMusicDiscs(id) {
      const params = {};
      if (id) {
        params.id = id;
      }
      axios.get(this.urlAPI, { params }).then((response) => {
        if (id) {
          this.infoResults = response.data;
          this.showInfo = true;
        } else {
          this.musicDiscs = response.data;
        }
      });
    },
    closeInfo() {
      this.showInfo = false;
    },
  },
  created() {
    this.getMusicDiscs();
  },
}).mount("#app");
