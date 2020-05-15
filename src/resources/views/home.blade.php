<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>
<body>
    <div id="app">
        <v-app>
            <v-bottom-navigation
            v-model="bottomNav"
          >
            <v-btn value="recent">
              <span>Recent</span>
              <v-icon>mdi-history</v-icon>
            </v-btn>

            <v-btn value="favorites">
              <span>Favorites</span>
              <v-icon>mdi-heart</v-icon>
            </v-btn>

            <v-btn value="nearby">
              <span>Nearby</span>
              <v-icon>mdi-map-marker</v-icon>
            </v-btn>
          </v-bottom-navigation>
        </v-app>
    </div>

    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>
