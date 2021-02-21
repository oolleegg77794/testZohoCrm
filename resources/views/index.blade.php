<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ZohoTest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <form action="/createRecord" method="POST">
            @csrf
            <h1>Create Deal</h1>
            <div class="form-group mt-2">
                <label for="Deal_Name">Deal Name</label>
                <input name="name" type="text" class="form-control" id="Deal_Name" placeholder="Deal Name">
            </div>
            <div class="form-group mt-2">
                <label for="Amount">Amount</label>
                <input name="amount" type="number" class="form-control" id="Amount" placeholder="Amount">
            </div>
            <div class="form-group mt-2">
                <label for="se_module" >Se_module</label>
                <select id="se_module" class="form-control" required>
                    <option selected disabled>Select se_module</option>
                    <option>Email</option>
                    <option>Call</option>
                    <option>Meeting</option>
                </select>
                <input type="hidden" name="se_module" value="" id="se_module_input">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create</button>
        </form>
    </div>

<script>
    let select = document.querySelector('#se_module'),
        se_module = document.querySelector('#se_module_input');

    select.addEventListener('change', () => {
        se_module.value = select.value;
    });
</script>
</body>
</html>
