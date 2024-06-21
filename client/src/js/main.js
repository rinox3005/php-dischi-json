const { createApp } = Vue;

createApp({
  data() {
    return {
      urlAPI: "http://localhost/php-dischi-json/server/server.php",
      urlAddNewDisk:
        "http://localhost/php-dischi-json/server/createNewDisc.php",
      musicDiscs: [],
      infoResults: {},
      showInfo: false,
      newDisc: {
        name: "",
        artist: "",
        description: "",
        cover: "",
        year: null,
        tracks: null,
      },
      message: "",
      showNewDiscForm: false,
    };
  },
  methods: {
    // Funzione che fa la chiamata axios e si aspetta un parametro id per le info della modale, se il parametro non c'é fa la chiamata classica
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
    // Funzione per la chiamata per aggiungere un nuovo disco
    addNewDisc() {
      // parametri passati dal form
      const data = {
        action: "create",
        name: this.newDisc.name,
        artist: this.newDisc.artist,
        description: this.newDisc.description,
        cover: this.newDisc.cover,
        year: this.newDisc.year,
        tracks: this.newDisc.tracks,
      };

      axios
        .post(this.urlAddNewDisk, data, {
          headers: { "Content-Type": "multipart/form-data" },
        })
        .then((response) => {
          // alla risposta richiamo la funzione per mostrarmi i dischi e azzero i campi
          if (response.data.success) {
            this.message = "Disc successfully added";
            this.getMusicDiscs();
            // this.closeNewDiscModal();
            this.newDisc = {
              name: "",
              artist: "",
              description: "",
              cover: "",
              year: null,
              tracks: null,
            };
            // se ottengo una risposya negativa restituisco un messaggio di errore
          } else {
            this.message = response.data.error;
          }
        })
        .catch((error) => {
          // se la chiamata non va a buon fine prendo l'errore e lo restituisco sotto forma di messaggio sia in console che in pagina
          console.error(error);
          this.message = "Error while adding new disc";
        });
    },
    // Funzione per chiudere la modale che mostra le info
    closeInfo() {
      this.showInfo = false;
    },
    // Metodo per mostrare la modale del form per il nuovo disco
    showNewDiscModal() {
      this.showNewDiscForm = true;
    },

    // Resetta i campi del form del nuovo disco
    resetNewDisc() {
      this.newDisc = {
        name: "",
        artist: "",
        description: "",
        cover: "",
        year: null,
        tracks: null,
      };
    },

    // Metodo per chiudere la modale del form per il nuovo disco
    closeNewDiscModal() {
      this.showNewDiscForm = false;
      this.resetNewDisc(); // Resetta i campi del form quando si chiude la modale
    },
  },
  created() {
    this.getMusicDiscs();
  },
}).mount("#app");
