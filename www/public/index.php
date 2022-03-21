<?php 
echo '
<body>
  <textarea id="textarea" cols="60" rows="8"></textarea>
  <input id="input"></input>
  <button id="button">Send</button>
  <script type="module">
    const textarea = document.getElementById("textarea");
    const input = document.getElementById("input");
    const button = document.getElementById("button");

    const socket = new WebSocket("wss://ws.jesusyaro.com/chat");

    const connection = async (socket, timeout = 10000) => {
      const isOpened = () => (socket.readyState === WebSocket.OPEN)

      if (socket.readyState !== WebSocket.CONNECTING) {
        return isOpened()
      }
      else {
        const intrasleep = 50
        const ttl = timeout / intrasleep // time to loop
        let loop = 0
        while (socket.readyState === WebSocket.CONNECTING && loop < ttl) {
          await new Promise(resolve => setTimeout(resolve, intrasleep))
          loop++
        }
        return isOpened()
      }
    }
    
    const opened = await connection(socket);

    socket.addEventListener("open", (event) => {
      console.log("Hello!", event);
    });

    socket.addEventListener("close", (event) => {
      console.log("close", event);
    });

    socket.addEventListener("error", (event) => {
      console.log("error", event);
    });

    socket.addEventListener("message", (event) => {
      console.log("Message from server ", event);
      textarea.value += `${event.data}\r\n`;
    });

    button.addEventListener("click", event => {
      socket.send(input.value);
      textarea.value += `${input.value}\r\n`;
      input.value = "";
    });

  </script>
</body>
';
?>
