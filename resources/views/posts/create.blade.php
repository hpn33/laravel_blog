Create Post
<form method="POST" action="/posts">
	@csrf

	<input name="title">
	<textarea name="body"></textarea>
	<button type="submit">
</form>