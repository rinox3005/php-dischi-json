const { createApp } = Vue;

createApp({
  data() {
    return {
      title: "Vue is working",
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
