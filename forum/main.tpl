<div class="home">
    <img src="amp.png">
    <a href="../main/">Back home</a>

    <form method="post">
        <input type="submit" class="submitButton" value="Exit" name="exit">
    </form>
</div>
<hr>

{messages}

<hr>
<h3 class="centerH3">Leave a message for young men</h3>
<h3 class="centerH3">{result}</h3>
<form method="post">
    <div>
        <label for="header">Header</label>
        <input type="text" id="header" name="header" value="{header}">
        <label for="message">Message</label>
        <textarea id="message" name="message">{message}</textarea>
        <input type="submit" id="create" class="submitButton" value="Create" name="create">        
    </div>
</form>