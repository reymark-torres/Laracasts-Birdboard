<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
</head>

<body>

    <form method="POST" action="/projects" class="container" style="padding-top: 40px">
        <h1 class="heading is-1">Create Project</h1>

        <div class="field">
            <label for="title">Title</label>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="title">
            </div>
        </div>

        <div class="field">
            <label for="description">Description</label>

            <div class="control">
                <textarea name="description" class="textarea"></textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-link">
                    Create Project
                </button>
            </div>
        </div>
    </form>
</body>

</html>
