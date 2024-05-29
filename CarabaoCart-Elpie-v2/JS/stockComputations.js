
document.addEventListener('DOMContentLoaded', function() {
    const addButtons = document.querySelectorAll('.add-btn');

    addButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const totalMilkAcceptedElement = document.querySelector('.available-stocks strong');
            let totalMilkAccepted = 0;
            if (totalMilkAcceptedElement) {
                totalMilkAccepted = parseFloat(totalMilkAcceptedElement.textContent) || 0;
            }

            const row = button.closest('tr'); // Get the closest table row (tr)
            const itemStockCell = row.querySelector('.item-stock'); // Get the item stock cell
            const totalCostCell = row.querySelector('.total-cost'); // Get the total cost cell
            const priceCell = row.querySelector('.product-price'); // Get the price cell
            const stockInput = row.querySelector(`input[name="stock[${row.querySelector('.product-name').textContent}]"]`); // Get the stock input based on product name

            // Extract and parse input values
            const stockToAdd = parseInt(stockInput.value) || 0; // Get the stock to add from input
            const currentStock = parseInt(itemStockCell.textContent) || 0; // Get the current stock from cell
            const itemPrice = parseFloat(priceCell.textContent.replace('₱', '')) || 0; // Get the item price from cell

            if (stockToAdd > totalMilkAccepted) {
                alert("Insufficient Stocks");
                stockInput.value = ''; // Reset the input value
                event.preventDefault();
                return;
            }

            // Update the item stock cell with total stock for this product
            const updatedStock = currentStock + stockToAdd;
            itemStockCell.textContent = updatedStock;

            // Calculate the total cost for this product
            const cost = stockToAdd * itemPrice;
            totalCostCell.textContent = '₱' + cost.toFixed(2); // Update the total cost cell with the calculated cost for this product

            // Subtract the added stock from the total milk accepted
            subtractFromTotalMilkAccepted(stockToAdd);

            // Submit form to update XML file
            const form = button.closest('form');
            const formData = new FormData(form);
            formData.append('totalMilkToUpdate', stockToAdd);
            fetch(form.action, {
                method: 'POST',
                body: formData
            });
        });
    });

    // Function to subtract the added stock from the total milk accepted
    function subtractFromTotalMilkAccepted(totalMilkToUpdate) {
        const totalMilkAcceptedElement = document.querySelector('.available-stocks strong');
        if (totalMilkAcceptedElement) {
            let totalMilkAccepted = parseFloat(totalMilkAcceptedElement.textContent) || 0; // Get the current total milk accepted
            totalMilkAccepted -= totalMilkToUpdate; // Subtract the added stock
            totalMilkAcceptedElement.textContent = totalMilkAccepted.toFixed(2); // Update the displayed value
        }
    }
});
