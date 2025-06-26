{extends file=$layout}
{assign var="page_title" value="Home"}

{block name="styles"}
    <style>
        .featured-courses {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-bottom: 30px;
}

.courses-grid {
    display: flex;
    flex-direction: column;
    gap: 2.5rem;
    width: 100%;
    max-width: 900px;
    align-items: center;
}

.course-card {
    display: flex;
    flex-direction: row;
    align-items: center;
    min-height: 200px;
    background: #fff;
    border-radius: 1rem;
    box-shadow: 0 4px 16px rgba(31,41,55,0.10);
    width: 100%;
    max-width: 900px;
    padding: 1.5rem 2rem;
    margin: 0 auto;
}

.course-card img {
    width: 300px;
    height: 180px;
    object-fit: cover;
    border-bottom: none;
    border-right: 1px solid #e5e7eb;
    border-radius: 0.8rem 0 0 0.8rem;
    margin-right: 2rem;
}

.course-info {
    padding: 1rem 1.5rem 1rem 0;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.featured-courses h2 {
    font-size: 2rem;
    color: #1e40af;
    margin-bottom: 2rem;
    border-bottom: 2px solid #3b82f6;
    padding-bottom: 0.3rem;
    text-align: center;
}

.course-info h3 {
    margin: 0 0 0.5rem 0;
    font-size: 1.5rem;
    color: #111827;
}

.course-info p {
    flex-grow: 1;
    font-size: 1.1rem;
    color: #6b7280;
    margin-bottom: 1rem;
}

.btn {
    align-self: flex-start;
    background-color: #3b82f6;
    color: white;
    padding: 0.7rem 1.4rem;
    border-radius: 0.5rem;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: background-color 0.2s ease;
}

.btn:hover {
    background-color: #2563eb;
}
 </style>
{/block}

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
{/block}
