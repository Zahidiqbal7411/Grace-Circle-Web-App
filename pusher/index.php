<!DOCTYPE html>
<html>
<head>
    <title>Realtime Insert Listener</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <h3>div 1 & 4</h3>
    <ul id="message_1_4"></ul>
    
    
    
    <h3>div 3 & 5</h3>
    <ul id="message_3_5"></ul>
    
    
    
    
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.7.3/firebase-app.js";
        import { getDatabase, ref, onChildAdded } from "https://www.gstatic.com/firebasejs/11.7.3/firebase-database.js";

        const firebaseConfig = {
            apiKey: "AIzaSyBog03t8CAhfy5y_dna9_FOHZUs7Sz2p6c",
            authDomain: "webtechfusion-6415f.firebaseapp.com",
            databaseURL: "https://webtechfusion-6415f-default-rtdb.firebaseio.com",
            projectId: "webtechfusion-6415f",
            storageBucket: "webtechfusion-6415f.appspot.com",
            messagingSenderId: "339830251948",
            appId: "1:339830251948:web:6f83d7cfb42bba91e01a09"
        };

        const app = initializeApp(firebaseConfig);
        const db = getDatabase(app);

        const dataRef = ref(db, 'Pusher'); // e.g., 'users', 'messages'

        onChildAdded(dataRef, (snapshot) => {
            const newData = snapshot.val();
            const key = snapshot.key;
			
			var html = '<li>' + newData.username + ':' + newData.message + '</li>';
			$('#' + newData.div_id).append(html);
			
			
        });
    </script>
</head>
<body>
    <h2>Realtime Insert Detection:</h2>
    <pre id="output"></pre>
</body>
</html>