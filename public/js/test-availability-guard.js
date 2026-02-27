// public/js/test-availability-guard.js

document.addEventListener('click', (e) => {
    const link = e.target.closest('a[data-test-link="1"]');
    if (!link) return;

    const available = (link.dataset.available ?? "1") === "1";

    // Si está disponible, dejamos navegar normal
    if (available) return;

    e.preventDefault();
    e.stopPropagation();

    const nextDate = link.dataset.nextDate || "";
    const remainingDaysRaw = link.dataset.remainingDays || "0";
    const remainingDays = Math.max(0, Math.ceil(parseFloat(remainingDaysRaw) || 0));

    let messageHtml = `
        Ya realizaste este test recientemente.<br><br>
    `;

    if (nextDate) {
        messageHtml += `
            Podrás volver a realizarlo el <strong>${nextDate}</strong>
            (${remainingDays} día${remainingDays === 1 ? '' : 's'} restantes).
        `;
    } else if (remainingDays > 0) {
        messageHtml += `
            Podrás volver a realizarlo en <strong>${remainingDays}</strong>
            día${remainingDays === 1 ? '' : 's'}.
        `;
    } else {
        messageHtml += `Podrás volver a realizarlo más adelante.`;
    }

    const modal = document.getElementById('testCooldownModal');
    const messageEl = document.getElementById('testModalMessage');
    const closeBtn = document.getElementById('closeTestModal');

    if (!modal || !messageEl || !closeBtn) return;

    messageEl.innerHTML = messageHtml;
    modal.style.display = 'flex';

    const close = () => { modal.style.display = 'none'; };

    closeBtn.onclick = close;
    modal.onclick = (ev) => { if (ev.target === modal) close(); };
}, true);