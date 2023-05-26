<div class="home">
    <img src="amp.png">
    <a href="../main/">Back home</a>
</div>
<form>
    <div>
        <label for="question">Enter you question</label>
        <input type="text" id="question">
        <input type="checkbox" id="onlyHeaders">
        <label for="onlyHeaders" id="onlyHeadersLabel">Only headers</label>
        <input type="submit" id="search" class="submitButton" value="Search">
    </div>
</form>
<hr>

{messages}

<hr>
<h3 class="centerH3">Leave a message for young men</h3>
<form method="post">
    <div>
        <label for="name">Your name</label>
        <input type="text" id="name" name="name">
        <label for="header">Header</label>
        <input type="text" id="header" name="header">
        <label for="message">Message</label>
        <textarea id="message" name="message"></textarea>
        <input type="submit" id="create" class="submitButton" value="Create" name="create">
    </div>
    {result}
</form>
