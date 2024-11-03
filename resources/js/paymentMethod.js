document.addEventListener('DOMContentLoaded', () => {
    window.addRow = () => {
        const targetRow = document.querySelectorAll('.infor');
        const last = targetRow[targetRow.length- 1];
        console.log(last);
        const newRowHTML = `
            <div class="row g-2 mt-2">
                <div class="col-6">
                    <input type="text" name="key[]" class="form-control" placeholder="key">
                </div>
                <div class="col-6">
                    <input type="text" name="value[]" class="form-control" placeholder="value">
                </div>
            </div>
        `;
        last?.insertAdjacentHTML('beforeend', newRowHTML);
    };
});