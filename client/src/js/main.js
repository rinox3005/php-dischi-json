const { createApp } = Vue;

createApp({
  data() {
    return {
      title: "PHP JSON DISCS",
      urlAPI: "http://localhost/php-dischi-json/server/server.php",
      musicDiscs: [],
    };
  },
  methods: {
    getMusicDiscs() {
      axios.get(this.urlAPI).then((response) => {
        this.musicDiscs = response.data;
      });
    },
  },
  created() {
    this.getMusicDiscs();
  },
}).mount("#app");
