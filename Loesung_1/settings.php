<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../loesung_2m/style.css" />
    <title>Settings</title>
  </head>
  <body>
    <h1>Profile Settings</h1>
    <form action="settings.html">
      <fieldset>
        <legend>Base Data</legend>
        <label for="name"> First Name </label>
        <input type="text" placeholder="Your name" id="name" name="name"/>
        <br />
        <label for="surname">Last Name</label>
        <input type="text" placeholder="Your surname" id="surname" name="surname"/>
        <br />
        Coffee or Tea?
        <select name="CoffeeOrTea">
          <option value="Coffee">Coffee</option>
          <option value="Neither">Neither nor</option>
          <option value="Tea">Tea</option>
        </select>
      </fieldset>
      <fieldset>
        <legend>Tell Something About You</legend>
        <textarea
          name="pin"
          id="steckbrief"
          name="steckbrief"
          cols="22"
          rows="2"
          placeholder="Leave a Comment here."
        ></textarea>
      </fieldset>
      <fieldset id="fieldset-settings">
        <legend>Prefered Chat Layout</legend>
        <input type="radio" name="layout"/>
        <label>Username and message in one line</label><br />
        <input type="radio" name="layout"/>
        <label>Username and message in separated lines</label>
      </fieldset>
      <input type="submit" value="Save" class="positive"/>
      <input type="submit" value="Cancel" class="danger" formaction="friends.html" />
    </form>
    <script src="./main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
