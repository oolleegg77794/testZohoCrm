<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ZohoTest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="/createRecord" method="POST">
            @csrf
            <h1>Create Deal</h1>
            <div class="form-group mt-2">
                <label for="Deal_Name">Deal name</label>
                <input name="name" type="text" class="form-control" id="Deal_Name" placeholder="Deal Name">
            </div>
            <div class="form-group mt-2">
                <label for="account_name">Account name</label>
                <select id="account_name" class="form-control" required>
                    <option selected disabled>Select account</option>
                    @foreach($data as $el)
                        <option data-account-id={{$el->getEntityId()}}>{{$el->getFieldValue("Account_Name")}}</option>
                    @endforeach
                </select>
                <input type="hidden" name="account_name" value="" id="account_name_input">
            </div>
            <div class="form-group mt-2">
                <label for="Description">Description</label>
                <input name="description" type="text" class="form-control" id="Description" placeholder="Description">
            </div>
            <div class="form-group mt-2">
                <label for="Amount">Amount</label>
                <input name="amount" type="text" class="form-control" id="Amount" placeholder="Amount">
            </div>
            <div class="form-group mt-2">
                <label for="se_module">Se module</label>
                <select id="se_module" class="form-control" required>
                    <option selected disabled>Select se module</option>
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
    let selectSeModule = document.querySelector('#se_module'),
        seModuleInput = document.querySelector('#se_module_input'),
        selectAccountName = document.querySelector('#account_name'),
        accountNameInput = document.querySelector('#account_name_input');

    selectSeModule.addEventListener('change', () => {
        seModuleInput.value = selectSeModule.value;
    });

    selectAccountName.addEventListener('change', () => {
        let selectedValue = selectAccountName.options[selectAccountName.selectedIndex];
        accountNameInput.value = selectedValue.getAttribute('data-account-id');
    });
</script>
</body>
</html>
