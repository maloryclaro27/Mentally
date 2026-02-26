// public/js/test-availability-guard.js
console.log('[guard] cargó test-availability-guard.js');

document.addEventListener('click', (e) => {
    const link = e.target.closest('a[data-test-link="1"]');
    if (!link) return;

    console.log('[guard] click en test:', {
        href: link.getAttribute('href'),
        available: link.dataset.available,
        testType: link.dataset.testType,
        nextDate: link.dataset.nextDate,
        remainingDays: link.dataset.remainingDays,
    });

    const available = (link.dataset.available ?? "1") === "1";
    console.log('[guard] available?', available, '-> shouldNavigate:', available ? 'YES' : 'NO');
    if (available) {
        console.log('[guard] dejando navegar a:', link.href);
        return;
    }

    e.preventDefault();
    e.stopPropagation();

    const testType = link.dataset.testType || "este test";
    const nextDate = link.dataset.nextDate || "";
    const remainingDaysRaw = link.dataset.remainingDays || "0";
    const remainingDays = Math.ceil(parseFloat(remainingDaysRaw) || 0);

    let msg = `Ya realizaste el test de ${testType}.`;
    if (nextDate) {
        msg += ` Podrás hacerlo de nuevo el ${nextDate} (faltan ${remainingDays} días).`;
    } else if (remainingDays > 0) {
        msg += ` Podrás hacerlo de nuevo en ${remainingDays} días.`;
    }

    const modal = document.getElementById('testCooldownModal');
    const messageEl = document.getElementById('testModalMessage');
    const closeBtn = document.getElementById('closeTestModal');

    console.log('[guard] modal elements:', {
        modal: !!modal,
        messageEl: !!messageEl,
        closeBtn: !!closeBtn
    });

    if (!modal || !messageEl || !closeBtn) {
        alert(msg);
        return;
    }

    messageEl.textContent = msg;
    modal.style.display = 'flex';

    const close = () => { modal.style.display = 'none'; };

    closeBtn.onclick = close;
    modal.onclick = (ev) => { if (ev.target === modal) close(); };
}, true);