<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Greatest Hits</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./client/src/css/style.css" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/7711c3f1fc.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="app" v-cloak>
        <main>
            <div class="mycontainer">
                <div class="logo">
                    <img src="./client/src/img/logo.png" alt="logo" />
                </div>
            </div>
            <div class="mycontainer">
                <!-- Contenitore degli album -->
                <div class="card-container">
                    <div class="newDisc">
                        <div class="addIcon" @click="showNewDiscModal()">
                            <i class="fa-solid fa-compact-disc"></i>
                            <i class="fa-solid fa-plus"></i>
                        </div>

                    </div>
                    <!-- Card che contiene album e dati -->
                    <div class="cards" v-for="disc in this.musicDiscs">
                        <div @click="getMusicDiscs(disc.id)">
                            <img class="cover" :src="disc.cover" :alt="disc.name" />
                            <h2>{{disc.name}}</h2>
                            <h3>{{disc.artist}}</h3>
                            <h4>{{disc.year}}</h4>
                        </div>
                        <!-- Eliminazione del disco -->
                        <i class="fas fa-xmark" @click="disc.checkDelete = true"></i>
                        <div class="overlay" v-if="disc.checkDelete">
                            <!-- Modale richiesta conferma eliminazione -->
                            <div class="checkDelete" v-show="disc.checkDelete">
                                <div class="mb-3 fw-bold">Confirm deleting disc?</div>
                                <button class="btn btn-success me-3" @click="deleteDisc(disc.id, index)">Yes</button>
                                <button class="btn btn-danger" @click="disc.checkDelete = false">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modale per mostrare le info del cd selezionato -->
            <div v-show="showInfo" class="info" @click.self="closeInfo()">
                <div class="info-content">
                    <!-- Pulsante di chiusura modale -->
                    <span class="close-info" @click="closeInfo()">&times;</span>
                    <!-- Cover e titolo -->
                    <div class="album">
                        <img class="cover-info" :src="infoResults.cover" :alt="infoResults.name" />
                        <h2>Album: <span>{{infoResults.name}}</span></h2>
                    </div>
                    <!-- Info Disco -->
                    <div class="disc-info">
                        <div>Artist: <span>{{infoResults.artist}}</span></div>
                        <div>Release: <span>{{infoResults.year}}</span></div>
                        <div>Tracks: <span>{{infoResults.tracks}}</span></div>
                        <p>{{infoResults.description}}</p>
                    </div>
                </div>
            </div>
            <!-- Modale per aggiungere un nuovo disco -->
            <div v-show="showNewDiscForm" class="newDiscForm">
                <div class="newDisc-content">
                    <span class="close-info" @click="closeNewDiscModal()">&times;</span>
                    <!-- Form aggiunta nuovo disco -->
                    <form @submit.prevent="addNewDisc()" class="p-4">
                        <h2 class="mb-4 text-danger">Add New Disc</h2>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" id="name" class="form-control" v-model="newDisc.name" required>
                        </div>
                        <div class="mb-3">
                            <label for="artist" class="form-label">Artist:</label>
                            <input type="text" id="artist" class="form-control" v-model="newDisc.artist" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea id="description" class="form-control" v-model="newDisc.description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="cover" class="form-label">Cover URL:</label>
                            <input type="text" id="cover" class="form-control" v-model="newDisc.cover" required>
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Year:</label>
                            <input type="number" id="year" class="form-control" v-model.number="newDisc.year" required>
                        </div>
                        <div class="mb-3">
                            <label for="tracks" class="form-label">Tracks:</label>
                            <input type="number" id="tracks" class="form-control" v-model.number="newDisc.tracks"
                                required>
                        </div>
                        <button type="submit" class="btn btn-danger">Add Disc</button>
                        <p class="mt-3">{{ message }}</p>
                    </form>
        </main>
    </div>
    <!-- Vue -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Custom Js -->
    <script type="module" src="./client/src/js/main.js"></script>
</body>

</html>