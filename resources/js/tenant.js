// Automatically fill domain based on tenant name
document.getElementById('name').addEventListener('input', function() {
    const nameValue = this.value.trim().toLowerCase().replace(/[^a-z0-9]/g, '');
    const domainInput = document.getElementById('domain');
    domainInput.value = nameValue ? `${nameValue}.com.jp` : '';
});
