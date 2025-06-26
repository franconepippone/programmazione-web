{extends file=$layout}

{block name="content"}
<section class="featured-courses">
    <h2>In primo piano</h2>
    <div class="courses-grid">
        <div class="course-card">
            <img src="https://th.bing.com/th/id/R.cfb192524373ad90827e8bee449d8ef7?rik=xzUU6Ko4lV2%2b9g&pid=ImgRaw&r=0" alt="Corso di Fotografia" />
            <div class="course-info">
                <h3>Corso di Fotografia</h3>
                <p>Impara le basi della fotografia digitale con tecniche pratiche e teoriche.</p>
                <a href="#" class="btn">Scopri di più</a>
            </div>
        </div>

        <div class="course-card">
            <img src="https://www.mondellopadel.it/public/corso-pade-base-palermo-b.jpg" alt="Programmazione Web" />
            <div class="course-info">
                <h3>Programmazione Web</h3>
                <p>Da zero a esperto: HTML, CSS, JavaScript e backend.</p>
                <a href="#" class="btn">Scopri di più</a>
            </div>
        </div>

        <div class="course-card">
            <img src="https://th.bing.com/th/id/OIP.LhWW6zJal4BrD6AecmPdhgHaEc?r=0&rs=1&pid=ImgDetMain&cb=idpwebp2&o=7&rm=3" alt="Cucina Italiana" />
            <div class="course-info">
                <h3>Cucina Italiana</h3>
                <p>Ricette e tecniche per diventare un cuoco italiano provetto.</p>
                <a href="#" class="btn">Scopri di più</a>
            </div>
        </div>
    </div>
</section>

<style>
    .featured-courses {
        margin-top: 2rem;
    }
    .featured-courses h2 {
        font-size: 1.5rem;
        color: #1e40af;
        margin-bottom: 1rem;
        border-bottom: 2px solid #3b82f6;
        padding-bottom: 0.3rem;
    }
    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.5rem;
    }
    .course-card {
        background: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 1px 5px rgb(0 0 0 / 0.1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s ease;
    }
    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgb(0 0 0 / 0.15);
    }
    .course-card img {
        width: 100%;
        height: 140px;
        object-fit: cover;
        border-bottom: 1px solid #e5e7eb;
    }
    .course-info {
        padding: 1rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .course-info h3 {
        margin: 0 0 0.5rem 0;
        font-size: 1.25rem;
        color: #111827;
    }
    .course-info p {
        flex-grow: 1;
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }
    .btn {
        align-self: flex-start;
        background-color: #3b82f6;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.4rem;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.2s ease;
    }
    .btn:hover {
        background-color: #2563eb;
    }
</style>
{/block}
