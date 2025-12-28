// public/js/detail.dynamic.js

(function () {
    const apiProduct = window.APP?.apiProduct;
    const slug = window.APP?.slug;

    if (!apiProduct || !slug) return;

    // loading off
    window.addEventListener("load", () => {
        const loading = document.getElementById("loading");
        if (loading) loading.style.display = "none";
    });

    // navbar hamburger
    const menuToggle = document.querySelectorAll(".menu-toggle input");
    const nav = document.querySelector("#navbar-1 ul");
    menuToggle.forEach((toggle) => {
        toggle.addEventListener("click", function () {
            nav.classList.toggle("slide");
            document.addEventListener("click", function (e) {
                if (e.target !== nav && e.target !== toggle) {
                    nav.classList.remove("slide");
                    toggle.checked = false;
                }
            });
        });
    });

    // cursor
    const cursor = document.querySelector(".cursor");
    const cursorInner = document.querySelector(".cursorInner");
    document.addEventListener("mousemove", (event) => {
        if (!cursor || !cursorInner) return;
        cursor.style.cssText = cursorInner.style.cssText =
            "left:" + event.clientX + "px; top:" + event.clientY + "px;";
    });

    const el = (tag, attrs = {}, children = []) => {
        const node = document.createElement(tag);
        Object.entries(attrs).forEach(([k, v]) => {
            if (k === "class") node.className = v;
            else if (k === "html") node.innerHTML = v;
            else node.setAttribute(k, v);
        });
        children.forEach((c) => node.appendChild(c));
        return node;
    };

    const formatRupiah = (n) => {
        try {
            return new Intl.NumberFormat("id-ID").format(n);
        } catch {
            return String(n);
        }
    };

    const stars = (rating) => {
        const r = Math.max(0, Math.min(5, Number(rating) || 0));
        let s = "";
        for (let i = 0; i < r; i++) s += "★";
        for (let i = r; i < 5; i++) s += "☆";
        return s;
    };

    async function init() {
        const root = document.getElementById("detail-root");
        if (!root) return;

        root.innerHTML = `<div style="text-align:center; font-size:18px; padding:30px;">Loading...</div>`;

        try {
            const res = await fetch(apiProduct, {
                headers: { Accept: "application/json" },
            });
            const json = await res.json();
            if (!json.success) throw new Error("API product gagal");

            const p = json.data.product;
            const options = json.data.options || {};
            const nut = json.data.nutrition || {};
            const testimonials = (json.data.testimonials || []).slice(0, 10);

            root.innerHTML = "";
            root.appendChild(renderHeader(p, options));
            root.appendChild(renderNutrition(nut));
            root.appendChild(renderTestimonials(testimonials));
        } catch (err) {
            console.error(err);
            root.innerHTML = `
        <div style="text-align:center; padding:40px;">
          <h2 style="color:#21963B;">Gagal memuat data</h2>
          <p style="color:#444;">Coba cek endpoint /api/product/${slug}</p>
        </div>
      `;
        }
    }

    function renderHeader(p, options) {
        const wrapper = el("div", { class: "detail-header" });

        // image
        const imgCard = el("div", { class: "detail-image-card" });
        imgCard.appendChild(el("img", { src: p.image_url, alt: p.name }));
        wrapper.appendChild(imgCard);

        // info
        const info = el("div", { class: "detail-info" });
        info.appendChild(el("div", { class: "detail-title", html: p.name }));
        info.appendChild(
            el("div", {
                class: "detail-subtitle",
                html: p.series_title || p.category_name || "",
            })
        );
        info.appendChild(
            el("div", {
                class: "detail-desc",
                html: p.short_description || "-",
            })
        );
        info.appendChild(
            el("div", {
                class: "detail-price",
                html: `Rp${formatRupiah(p.price)}`,
            })
        );

        const order = el("div", { class: "detail-order" });
        if (p.gofood_url)
            order.appendChild(
                el("a", {
                    href: p.gofood_url,
                    target: "_blank",
                    rel: "noopener",
                    html: "GO FOOD",
                })
            );
        if (p.grabfood_url)
            order.appendChild(
                el("a", {
                    href: p.grabfood_url,
                    target: "_blank",
                    rel: "noopener",
                    html: "GRAB FOOD",
                })
            );
        if (p.shopeefood_url)
            order.appendChild(
                el("a", {
                    href: p.shopeefood_url,
                    target: "_blank",
                    rel: "noopener",
                    html: "SHOPEE FOOD",
                })
            );
        info.appendChild(order);

        // options size/ice/sugar
        const optGrid = el("div", { class: "detail-options" });
        optGrid.appendChild(renderOptCard("Ukuran", options.size || []));
        optGrid.appendChild(renderOptCard("Es", options.ice || []));
        optGrid.appendChild(renderOptCard("Gula", options.sugar || []));
        info.appendChild(optGrid);

        wrapper.appendChild(info);
        return wrapper;
    }

    function renderOptCard(title, items) {
        const card = el("div", { class: "opt-card" });
        card.appendChild(el("div", { class: "opt-title", html: title }));

        const row = el("div", { class: "opt-items" });
        if (!items.length) {
            row.appendChild(el("span", { class: "opt-pill", html: "-" }));
        } else {
            items.forEach((it) =>
                row.appendChild(
                    el("span", { class: "opt-pill", html: it.label })
                )
            );
        }

        card.appendChild(row);
        return card;
    }

    function renderNutrition(n) {
        const section = el("div");
        section.appendChild(
            el("div", { class: "section-title", html: "Informasi Nutrisi" })
        );

        const grid = el("div", { class: "nutrition-grid" });

        grid.appendChild(nutriCard(n.calories_kcal ?? "-", "Kalori (kcal)"));
        grid.appendChild(nutriCard(n.sugar_g ?? "-", "Gula (g)"));
        grid.appendChild(nutriCard(n.protein_g ?? "-", "Protein (g)"));
        grid.appendChild(nutriCard(n.fat_g ?? "-", "Lemak (g)"));

        section.appendChild(grid);

        if (n.note) {
            section.appendChild(
                el("div", {
                    style: "text-align:center; margin-top:10px; font-size:13px; color:rgba(0,0,0,0.55);",
                    html: n.note,
                })
            );
        }

        return section;
    }

    function nutriCard(value, label) {
        const card = el("div", { class: "nutri-card" });
        card.appendChild(el("div", { class: "nutri-value", html: value }));
        card.appendChild(el("div", { class: "nutri-label", html: label }));
        return card;
    }

    function renderTestimonials(list) {
        const section = el("div");
        section.appendChild(
            el("div", { class: "section-title", html: "Testimoni" })
        );

        if (!list.length) {
            section.appendChild(
                el("div", {
                    style: "text-align:center; font-size:15px; color:#444;",
                    html: "Belum ada testimoni.",
                })
            );
            return section;
        }

        const wrap = el("div", { class: "testi-wrap" });

        list.forEach((t) => {
            const card = el("div", { class: "testi-card" });

            const head = el("div", { class: "testi-head" });
            head.appendChild(
                el("div", { class: "testi-name", html: t.name || "Anonim" })
            );
            head.appendChild(
                el("div", { class: "testi-stars", html: stars(t.rating) })
            );
            card.appendChild(head);

            card.appendChild(
                el("div", { class: "testi-msg", html: t.message || "-" })
            );
            if (t.created_at)
                card.appendChild(
                    el("div", { class: "testi-date", html: t.created_at })
                );

            wrap.appendChild(card);
        });

        section.appendChild(wrap);
        return section;
    }

    init();
})();
