//AddEventListener
document.addEventListener('DOMContentLoaded', function() {
    const depositButtons = document.querySelectorAll('.depositButton');
    const totalMilkDeposit = document.getElementById('totalMilkDeposit');
    const totalMilkRejected = document.getElementById('totalMilkRejected');
    const totalMilkAccepted = document.getElementById('totalMilkAccepted');
    const totalCost = document.getElementById('totalCost');
    
    depositButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userID = button.getAttribute('data-userid');
            const milkDepositInput = document.querySelector('input[name="milk_deposit[' + userID + ']"]');
            const rejectedMilkInput = document.querySelector('input[name="rejected_milk[' + userID + ']"]');
            const acceptedCell = button.parentElement.nextElementSibling;
            const costCell = acceptedCell.nextElementSibling;
            const timeCell = costCell.nextElementSibling;
            
            const milkDeposit = parseFloat(milkDepositInput.value) || 0; // Default to 0 if empty or NaN
            const rejectedMilk = parseFloat(rejectedMilkInput.value) || 0; // Default to 0 if empty or NaN
            const acceptedMilk = milkDeposit - rejectedMilk;
            const cost = acceptedMilk * 100; // Assuming cost is 100 per liter
            
            acceptedCell.textContent = isNaN(acceptedMilk) ? '' : acceptedMilk.toFixed(2); // Set to empty string if NaN
            costCell.textContent = isNaN(cost) ? '' : '₱' + cost.toFixed(2); // Set to empty string if NaN
            timeCell.textContent = new Date().toLocaleString(); // Add current time
            
            updateTotal();
        });
    });
    
    function updateTotal() {
        let totalDeposit = 0;
        let totalRejected = 0;
        let totalAccepted = 0;
        let totalCostValue = 0;
        
        depositButtons.forEach(button => {
            const userID = button.getAttribute('data-userid');
            const milkDepositInput = document.querySelector('input[name="milk_deposit[' + userID + ']"]');
            const rejectedMilkInput = document.querySelector('input[name="rejected_milk[' + userID + ']"]');
            
            const milkDeposit = parseFloat(milkDepositInput.value) || 0; // Default to 0 if empty or NaN
            const rejectedMilk = parseFloat(rejectedMilkInput.value) || 0; // Default to 0 if empty or NaN
            const acceptedMilk = milkDeposit - rejectedMilk;
            const cost = acceptedMilk * 100; // Assuming cost is 100 per liter
            
            totalDeposit += milkDeposit;
            totalRejected += rejectedMilk;
            totalAccepted += isNaN(acceptedMilk) ? 0 : acceptedMilk; // Consider 0 if acceptedMilk is NaN
            totalCostValue += isNaN(cost) ? 0 : cost; // Consider 0 if cost is NaN
        });
        
        totalMilkDeposit.textContent = totalDeposit.toFixed(2);
        totalMilkRejected.textContent = totalRejected.toFixed(2);
        totalMilkAccepted.textContent = totalAccepted.toFixed(2);
        totalCost.textContent = '₱' + totalCostValue.toFixed(2);
    }
    
    // Initial total update
    updateTotal();
});

