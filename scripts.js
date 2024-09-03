// let entryCount = 1;

// function addEntry() {
//     entryCount++;
//     const newEntry = document.createElement('div');
//     newEntry.className = 'entry';
//     newEntry.innerHTML = `
//         <h3>Entry No ${entryCount}</h3>
//         <div class="form-group">
//             <label for="transactionDate${entryCount}">Transaction Date:</label>
//             <input type="date" id="transactionDate${entryCount}" name="transactionDate[]" >
//         </div>
//         <div class="form-group">
//             <label for="particularsAsset${entryCount}">Particulars of Asset:</label>
//             <input type="text" id="particularsAsset${entryCount}" name="particularsAsset[]" >
//         </div>
//         <div class="form-group">
//             <h4>Particulars of Suppliers</h4>
//             <label for="supplierName${entryCount}">Name:</label>
//             <input type="text" id="supplierName${entryCount}" name="supplierName[]" >
//             <label for="supplierAddress${entryCount}">Address:</label>
//             <input type="text" id="supplierAddress${entryCount}" name="supplierAddress[]">
//             <label for="billNo${entryCount}">Bill No.:</label>
//             <input type="text" id="billNo${entryCount}" name="billNo[]" >
//             <label for="billDate${entryCount}">Bill Date:</label>
//             <input type="date" id="billDate${entryCount}" name="billDate[]" >
//         </div>
//         <div class="form-group">
//             <h4>Cost of Asset</h4>
//             <label for="additions${entryCount}">Additions:</label>
//             <input type="number" id="additions${entryCount}" name="additions[]" step="0.01" >
//             <label for="deductions${entryCount}">Deductions:</label>
//             <input type="number" id="deductions${entryCount}" name="deductions[]" step="0.01">
//         </div>
//         <div class="form-group">
//                         <b><label for = "document${entryCount}">Upload Corresponding Documents </label></b>
//                         <div id="docs1" class="docs-container">
//                             <div class="document-upload" style="display: inline;">
//                                 <p>Document Title: 
//                                     <input type="text" id="documentTitle${entryCount}" name="documentTitle[]" style="width: 15%;">
//                                     <input type="file" id="documentUpload${entryCount}" name="documentUpload[]" accept="application/pdf" style="width: 20%;">
//                                 </p>
//                             </div>
//                         </div>
//                         <button type="button" class="add-more-doc-btn" onclick="addDocumentEntry(1)">Add More</button>
//         </div>
        
//     `;
//     document.getElementById('entries').appendChild(newEntry);
// }
let entryCount = 1;

function addEntry() {
    entryCount++;
    const newEntry = document.createElement('div');
    newEntry.className = 'entry';
    newEntry.innerHTML = `
        <h3>Entry No ${entryCount}</h3>
        <div class="form-group">
            <label for="transactionDate${entryCount}">Transaction Date:</label>
            <input type="date" id="transactionDate${entryCount}" name="transactionDate[]" >
        </div>
        <div class="form-group">
            <label for="particularsAsset${entryCount}">Particulars of Asset:</label>
            <input type="text" id="particularsAsset${entryCount}" name="particularsAsset[]" >
        </div>
        <div class="form-group">
            <h4>Particulars of Suppliers</h4>
            <label for="supplierName${entryCount}">Name:</label>
            <input type="text" id="supplierName${entryCount}" name="supplierName[]" >
            <label for="supplierAddress${entryCount}">Address:</label>
            <input type="text" id="supplierAddress${entryCount}" name="supplierAddress[]">
            <label for="billNo${entryCount}">Bill No.:</label>
            <input type="text" id="billNo${entryCount}" name="billNo[]" >
            <label for="billDate${entryCount}">Bill Date:</label>
            <input type="date" id="billDate${entryCount}" name="billDate[]" >
        </div>
        <div class="form-group">
            <h4>Cost of Asset</h4>
            <label for="additions${entryCount}">Additions:</label>
            <input type="number" id="additions${entryCount}" name="additions[]" step="0.01" >
            <label for="deductions${entryCount}">Deductions:</label>
            <input type="number" id="deductions${entryCount}" name="deductions[]" step="0.01">
        </div>
        <div class="form-group">
            <b><label for="document${entryCount}">Upload Corresponding Documents</label></b>
            <div id="docs${entryCount}" class="docs-container">
                <div class="document-upload" style="display: inline;">
                    <p>Document Title: 
                        <input type="text" id="documentTitle${entryCount}" name="documentTitle${entryCount}[]" style="width: 15%;">
                        <input type="file" id="documentUpload${entryCount}" name="documentUpload${entryCount}[]" accept="application/pdf" style="width: 20%;">
                    </p>
                </div>
            </div>
            <button type="button" class="add-more-doc-btn" onclick="addDocumentEntry(${entryCount})">Add More</button>
        </div>
    `;
    document.getElementById('entries').appendChild(newEntry);
}

function addDocumentEntry(entryNumber) {
    const docsContainer = document.getElementById(`docs${entryNumber}`);
    const newDocEntry = document.createElement('div');
    newDocEntry.className = 'document-upload';
    newDocEntry.style.display = 'inline';
    newDocEntry.innerHTML = `
        <p>Document Title: 
            <input type="text" name="documentTitle${entryNumber}[]" style="width: 15%;">
            <input type="file" name="documentUpload${entryNumber}[]" accept="application/pdf" style="width: 20%;">
        </p>
    `;
    docsContainer.appendChild(newDocEntry);
}

document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.has-submenu > a');

    menuItems.forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();
            const submenu = this.parentElement;
            submenu.classList.toggle('submenu-active');
        });
    });
});

