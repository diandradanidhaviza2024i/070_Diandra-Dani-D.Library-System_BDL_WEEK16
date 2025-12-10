
// THEME TOGGLE
const toggle = document.getElementById("themeToggle");
const current = localStorage.getItem("theme") || "light";

if (current === "dark") {
    document.documentElement.setAttribute("data-theme", "dark");
}

if (toggle) {
    toggle.addEventListener("click", () => {
        const t = document.documentElement.getAttribute("data-theme") === "dark"
            ? "light"
            : "dark";
        document.documentElement.setAttribute("data-theme", t);
        localStorage.setItem("theme", t);

        showToast(`Tema diubah ke ${t === "dark" ? "Dark Mode" : "Light Mode"}`);
    });
}

// FADE-IN ANIMATION
document.addEventListener("DOMContentLoaded", () => {
    document.querySelector(".container")?.classList.add("fade-in");
    document.querySelector("table")?.classList.add("fade-in-slow");
});

// HIGHLIGHT OVERDUE ROWS
document.querySelectorAll("tbody tr").forEach(tr => {
    const overdueCell = tr.querySelector("td[data-overdue]");
    if (!overdueCell) return;

    const overdue = parseInt(overdueCell.dataset.overdue);

    if (overdue > 0) {
        tr.classList.add("row-overdue");
    }
});


// AUTO SEARCH (FILTER LANGSUNG)
const searchInput = document.getElementById("searchBox");

if (searchInput) {
    searchInput.addEventListener("keyup", () => {
        const filter = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll("tbody tr");

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });
}

// MODERN CONFIRM POPUP
function confirmAction(message, callback) {
    const box = document.createElement("div");
    box.classList.add("confirm-box");
    box.innerHTML = `
        <div class="confirm-card">
            <p>${message}</p>
            <div class="confirm-btns">
                <button id="yesBtn">Ya</button>
                <button id="noBtn">Batal</button>
            </div>
        </div>
    `;
    document.body.appendChild(box);

    document.getElementById("yesBtn").onclick = () => {
        callback(true);
        box.remove();
    };
    document.getElementById("noBtn").onclick = () => box.remove();
}

// override default confirm()
window.confirm = (msg) => {
    return new Promise((resolve) => confirmAction(msg, resolve));
};

// SNACKBAR / TOAST
function showToast(text) {
    const toast = document.createElement("div");
    toast.className = "toast";
    toast.innerText = text;

    document.body.appendChild(toast);

    setTimeout(() => toast.classList.add("show"), 10);
    setTimeout(() => {
        toast.classList.remove("show");
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
