<div class="modal_form">
    <a class="close">X</a>
    <form method="POST" action="/dataview">
        @csrf
        @method('POST')
        <div class="date">
            <p>Date:</p>
            <input type="date" name="date" required>
        </div>

        <div class="category">
            <p>Category:</p>
            <input type="text" name="category" required>
        </div>

        <div class="lot_title">
            <p>Lot Title:</p>
            <input type="text" name="lot_title" required>
        </div>

        <div class="lot_location">
            <p>Lot Location:</p>
            <input type="text" name="lot_location" required>
        </div>

        <div class="lot_condition">
            <p>Lot Condition</p>
            <input type="text" name="lot_condition" required>
        </div>

        <div class="pre-tax_amount">
            <p>Pre Tax Amount:</p>
            <input type="number" step="0.01" min="0" name="pre-tax_amount" required>
        </div>

        <div class="tax_name">
            <p>Tax Name:</p>
            <input type="text" name="tax_name">
        </div>

        <div class="tax_amount">
            <p>Tax Amount:</p>
            <input type="number" step="0.01" min="0" name="tax amount">
        </div>

        <button class="submit" style="margin:20px 0px" type="submit">Add Data</button>

    </form>

</div>
