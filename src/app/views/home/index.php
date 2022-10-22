<h1> Welcome to Binotify </h1>
<form method="post" action="/search">
<input type="hidden" name="page" value="1"/>
<input type="text" name="q" id="q" placeholder="Masukkan judul, tahun, penyanyi" autocomplete="off" required/>
<label for="sort">A-Z:</label>
<select name="sort" id="sort">
    <option value="Asc">Ascending</option>
    <option value="Desc">Descending</option>
</select>
<label for="genre">Genre:</label>
<input type="text" name="genre" id="genre" placeholder="pop, rock" autocomplete="off"/>

<button type="submit">Search</button>
</form>