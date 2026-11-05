<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Content-type: text/html; charset=utf-8");

$id = intval($_GET['id'] ?? 1);

/*
 ═══════════════════════════════════════════════════════════
  DONNÉES DES ÉPISODES
  → Modifie ce tableau pour chaque épisode.
  
  Pour la vidéo :
    - YouTube : mettre l'ID de la vidéo (ex: "dQw4w9WgXcQ")
      → la page génère automatiquement l'embed
    - URL directe : mettre l'URL complète d'un fichier .mp4
    - Vimeo : mettre l'ID (ex: "123456789") + type: "vimeo"
 ══════════════════════════════════════════════════════════
*/
$episodes = [
    1 => [
        'numero'   => '01',
        'titre'    => 'La Cérémonie des walids',
        'soustitre'=> '',
        'desc'     => ' La cérémonie des Walids sert à récompenser les projets des différents étudinats de Laval dans une cérémonie ressemblant à 
        celle des awards. ',
        'fait'     => 'Lors de la cérémonie des Walide de 2026, j’ai occupé le rôle d’assistant réalisateur. 
Je participais à l’organisation et au suivi de la réalisation durant l’événement afin d’aider au bon déroulement de celui-ci. 
Je me suis également occupé de la création des affichages visuels utilisés pendant la cérémonie, ainsi que des vidéos, images et sous-titres diffusés sur les différents médias vidéo.',
        'appris'   => '',
        'image'    => '',
        'video_id' => 'ro4-9omuIvQ',          /* ← Colle ici l'ID YouTube, ex: dQw4w9WgXcQ */
        'video_type' => 'youtube', /* youtube | vimeo | direct */
        'duree'    => '14 min',
        'date'     => 'le 27 janvier 2026',
        'tags'     => [''],
    ],
    2 => [
        'numero'   => '02',
        'titre'    => 'Émissions d\'Halloween',
        'soustitre'=> '',
       'desc'=>'J’ai également été animateur lors d’une émission spéciale sur le thème d’Halloween. 
Durant ce projet, mon rôle était de présenter les différentes séquences de l’émission tout en maintenant une ambiance dynamique et divertissante adaptée au thème. 
Je devais donc adapter ma prise de parole en fonction de l’ambiance Halloween afin de rendre l’émission plus immersive et intéressante pour le public.

Cette expérience m’a permis de travailler mon aisance à l’oral, ma gestion du stress face à la caméra et ma capacité à capter l’attention du public. 
J’ai également appris à collaborer avec une équipe de production, à respecter un conducteur d’émission et à m’adapter aux contraintes d’un tournage audiovisuel.',
        'fait'     => 'J\'ai préparé la grille de questions, conduit une partie de l\'interview et réalisé le montage final. J\'ai également conçu la vignette de couverture.',
        'appris'   => 'Conduite d\'une interview journalistique|Montage d\'un fichier audio long|Conception d\'une vignette de podcast|Travail en binôme sur un projet audio',
        'image'    => '',
        'video_id' => 'sbYuXex33Co',
        'video_type' => 'youtube',
        'duree'    => '22 min',
        'date'     => 'Décembre 2024',
        'tags'     => [''],
    ],
    3 => [
        'numero'   => '03',
        'titre'    => 'Émissions sur Mario Party',
        'soustitre'=> 'Prise de position et analyse',
       'desc'     => 'Participation à l’animation au cœur d’un jeu type Mario Party, avec des épreuves ludiques et interactives. L’objectif était de dynamiser l’événement en faisant vivre une expérience immersive aux participants.',
        'fait'     => 'J\'ai écrit et enregistré la chronique, puis effectué le montage sonore avec habillage musical.',
        'appris'   => 'Écriture radiophonique|Habillage sonore|Expression orale travaillée|Synthèse d\'une problématique en format court',
        'image'    => '',
        'video_id' => 'wCIynB7vatc',
        'video_type' => 'youtube',
        'duree'    => '8 min',
        'date'     => 'Janvier 2025',
        'tags'     => [''],
    ],
    4 => [
        'numero'   => '04',
        'titre'    => 'Émissions du jeu du loup garou (reddif pas encore dispo)',
        'soustitre'=> 'Ce qu\'on a appris, ce qu\'on refait',
        'desc'     => 'Dernier épisode de la saison. On revient ensemble sur les meilleurs moments du jeu du Loup-Garou, on analyse les différentes parties et stratégies utilisées, et on partage nos impressions à chaud après cette expérience d’animation et de jeu collectif.',
        'fait'     => 'J\'ai coordonné l\'ensemble du bilan, réuni les retours de l\'équipe et conçu la structure narrative de cet épisode conclusif.',
        'appris'   => 'Gestion de projet collectif|Recul critique sur une production|Communication d\'équipe|Narration d\'un bilan',
        'image'    => '',
        'video_id' => 'indisponible',
        'video_type' => 'youtube',
        'duree'    => '18 min',
        'date'     => 'Février 2025',
        'tags'     => [''],
    ],
];

$ep = $episodes[$id] ?? $episodes[1];
$apprisList = array_filter(array_map('trim', explode('|', $ep['appris'])));
$prevId = ($id > 1 && isset($episodes[$id - 1])) ? $id - 1 : null;
$nextId = isset($episodes[$id + 1]) ? $id + 1 : null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($ep['titre']); ?> — Studio — Mael Rabah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    <style>

    /* ── Page épisode ─────────────────────────────────── */
    .episode-page { min-height: 100vh; }

    /* Hero */
    .ep-hero {
        position: relative;
        height: 55vh;
        min-height: 380px;
        overflow: hidden;
        background: #0a0a0e;
    }
    .ep-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom,
            rgba(4,4,6,0.3) 0%,
            rgba(4,4,6,0.5) 60%,
            rgba(4,4,6,1) 100%);
    }
    .ep-hero-topbar {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--gold, #b8975a), rgba(184,151,90,0.2), transparent);
    }
    .ep-hero-back {
        position: absolute;
        top: 1.5rem;
        left: 2rem;
        z-index: 10;
    }
    .ep-hero-back a {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.7rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.45);
        text-decoration: none;
        transition: color 0.2s;
    }
    .ep-hero-back a:hover { color: var(--gold, #b8975a); }
    .ep-hero-back svg { width: 15px; }

    .ep-hero-content {
        position: absolute;
        bottom: 2.5rem;
        left: 2.5rem;
        right: 2.5rem;
        z-index: 5;
        max-width: 800px;
    }
    .ep-numero {
        font-size: 0.62rem;
        letter-spacing: 0.35em;
        text-transform: uppercase;
        color: var(--gold, #b8975a);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }
    .ep-numero::before {
        content: '';
        width: 30px;
        height: 1px;
        background: var(--gold, #b8975a);
    }
    .ep-titre {
        font-family: 'Cormorant Garamond', Georgia, serif;
        font-size: clamp(2rem, 5vw, 3.8rem);
        font-weight: 600;
        color: #ede8e0;
        line-height: 1.1;
        margin-bottom: 0.6rem;
    }
    .ep-soustitre {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.45);
        font-style: italic;
    }

    /* Tags hero */
    .ep-tags {
        position: absolute;
        bottom: 2.5rem;
        right: 2.5rem;
        z-index: 5;
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
        align-items: flex-end;
    }
    .ep-tag {
        font-size: 0.58rem;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        padding: 0.25rem 0.65rem;
        border-radius: 3px;
        background: rgba(184,151,90,0.1);
        border: 1px solid rgba(184,151,90,0.2);
        color: var(--gold, #b8975a);
    }

    /* ── Corps ─────────────────────────────────────────── */
    .ep-body {
        max-width: 1100px;
        margin: 0 auto;
        padding: 4rem 2rem 6rem;
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 4rem;
    }

    /* Vidéo */
    .ep-video-wrap {
        position: relative;
        aspect-ratio: 16/9;
        background: #0e0e14;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid rgba(184,151,90,0.12);
        margin-bottom: 3rem;
    }
    .ep-video-wrap iframe,
    .ep-video-wrap video {
        width: 100%;
        height: 100%;
        position: absolute;
        inset: 0;
        border: none;
        display: block;
    }
    /* Placeholder quand pas de vidéo */
    .ep-video-placeholder {
        width: 100%;
        height: 100%;
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        color: rgba(255,255,255,0.2);
    }
    .ep-video-placeholder svg { width: 40px; opacity: 0.4; }
    .ep-video-placeholder span { font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; }

    /* Sections texte */
    .ep-section { margin-bottom: 2.5rem; }
    .ep-section-label {
        font-size: 0.58rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--gold, #b8975a);
        font-weight: 600;
        margin-bottom: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .ep-section-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: rgba(184,151,90,0.15);
    }
    .ep-text {
        font-size: 0.93rem;
        color: var(--text2, #8c8880);
        line-height: 1.85;
    }
    .ep-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
    }
    .ep-list li {
        font-size: 0.9rem;
        color: var(--text2, #8c8880);
        padding-left: 1.3rem;
        position: relative;
        line-height: 1.65;
    }
    .ep-list li::before {
        content: '◉';
        position: absolute;
        left: 0;
        top: 0.3rem;
        font-size: 0.45rem;
        color: var(--gold, #b8975a);
    }

    /* Sidebar */
    .ep-sidebar-card {
        background: #0e0e14;
        border: 1px solid rgba(184,151,90,0.12);
        border-radius: 10px;
        overflow: hidden;
        position: sticky;
        top: 6rem;
    }
    .ep-sidebar-card-top {
        height: 2px;
        background: linear-gradient(90deg, var(--gold,#b8975a), rgba(184,151,90,0.15), transparent);
    }
    .ep-sidebar-body { padding: 1.5rem; }
    .ep-meta-row {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
        margin-bottom: 1.25rem;
        padding-bottom: 1.25rem;
        border-bottom: 1px solid rgba(255,255,255,0.04);
    }
    .ep-meta-row:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
    .ep-meta-label {
        font-size: 0.55rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--gold,#b8975a);
    }
    .ep-meta-val {
        font-size: 0.88rem;
        color: var(--text2, #8c8880);
    }

    /* Nav épisodes */
    .ep-nav {
        display: flex;
        gap: 0.75rem;
        margin-top: 3rem;
        flex-wrap: wrap;
    }
    .ep-nav-btn {
        flex: 1;
        min-width: 120px;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.9rem 1rem;
        border-radius: 8px;
        border: 1px solid rgba(255,255,255,0.06);
        background: rgba(255,255,255,0.01);
        color: var(--text3,#5c5a55);
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.25s;
    }
    .ep-nav-btn:hover { border-color: rgba(184,151,90,0.3); color: var(--gold,#b8975a); }
    .ep-nav-btn.ep-nav-next { justify-content: flex-end; text-align: right; }
    .ep-nav-btn span { flex: 1; }

    /* Responsive */
    @media (max-width: 900px) {
        .ep-body { grid-template-columns: 1fr; gap: 2rem; }
        .ep-tags { display: none; }
        .ep-sidebar-card { position: static; }
    }
    @media (max-width: 600px) {
        .ep-hero-content { left: 1.25rem; right: 1.25rem; bottom: 1.5rem; }
        .ep-body { padding: 2rem 1.25rem 4rem; }
    }
    </style>
</head>
<body>

<div class="cursor-dot" id="cursorDot"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- NAV -->
<header>
    <nav id="navbar">
        <ul class="nav-links" id="navLinks">
            <li><a href="index.php#hero">Présentation</a></li>
            <li class="nav-dropdown">
                <a href="projets.php">Domaines <span class="nav-arrow">▾</span></a>
                <ul class="nav-sub">
                    <li><a href="projets.php?cat=strat">Stratégie de communication</a></li>
                    <li><a href="projets.php?cat=crea">Création numérique</a></li>
                    <li><a href="projets.php?cat=dev">Développement numérique</a></li>
                </ul>
            </li>
            <li><a href="projets.php">Projets</a></li>
            <li><a href="index.php#studio" class="active">Studio</a></li>
            <li><a href="index.php#contact">Contact</a></li>
        </ul>
        <button class="burger" id="burger" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
        <a href="index.php" class="nav-logo">MR<span class="dot">.</span></a>
    </nav>
</header>

<div class="episode-page">

    <!-- ── HERO ─────────────────────────────────────────────── -->
    <div class="ep-hero">
        <div class="ep-hero-bg"></div>
        <div class="ep-hero-overlay"></div>
        <div class="ep-hero-topbar"></div>


        <div class="ep-hero-content">
            <div class="ep-numero">Épisode <?php echo htmlspecialchars($ep['numero']); ?></div>
            <h1 class="ep-titre"><?php echo htmlspecialchars($ep['titre']); ?></h1>
            <p class="ep-soustitre"><?php echo htmlspecialchars($ep['soustitre']); ?></p>
        </div>

        <div class="ep-tags">
            <?php foreach ($ep['tags'] as $tag): ?>
            <span class="ep-tag"><?php echo htmlspecialchars($tag); ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ── CORPS ─────────────────────────────────────────────── -->
    <div class="ep-body">

        <!-- COLONNE PRINCIPALE -->
        <div>

            <!-- Vidéo -->
            <div class="ep-video-wrap">
                <?php if (!empty($ep['video_id'])): ?>
                    <?php if ($ep['video_type'] === 'youtube'): ?>
                    <iframe
                        src="https://www.youtube.com/embed/<?php echo htmlspecialchars($ep['video_id']); ?>?rel=0&modestbranding=1"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                    <?php elseif ($ep['video_type'] === 'vimeo'): ?>
                    <iframe
                        src="https://player.vimeo.com/video/<?php echo htmlspecialchars($ep['video_id']); ?>?title=0&byline=0&portrait=0"
                        allow="autoplay; fullscreen; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                    <?php else: ?>
                    <video src="<?php echo htmlspecialchars($ep['video_id']); ?>" controls></video>
                    <?php endif; ?>
                <?php else: ?>
                <div class="ep-video-placeholder">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <circle cx="12" cy="12" r="10"/>
                        <polygon points="10 8 16 12 10 16 10 8"/>
                    </svg>
                    <span>Vidéo à venir</span>
                </div>
                <?php endif; ?>
            </div>

            <!-- Description -->
            <div class="ep-section">
                <div class="ep-section-label">Présentation</div>
                <p class="ep-text"><?php echo nl2br(htmlspecialchars($ep['desc'])); ?></p>
            </div>

            <!-- Ce que j'ai fait -->
            <?php if (!empty($ep['fait'])): ?>
            <div class="ep-section">
                <div class="ep-section-label">Ce que j'ai fait</div>
                <p class="ep-text"><?php echo nl2br(htmlspecialchars($ep['fait'])); ?></p>
            </div>
            <?php endif; ?>

            <!-- Ce que j'ai appris -->
            <?php if (!empty($apprisList)): ?>
            <div class="ep-section">
                <div class="ep-section-label">Ce que j'ai appris</div>
                <ul class="ep-list">
                    <?php foreach ($apprisList as $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- Navigation -->
            <div class="ep-nav">
                <?php if ($prevId): ?>
                <a href="studio-episode.php?id=<?php echo $prevId; ?>" class="ep-nav-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    <span>Épisode <?php echo str_pad($prevId, 2, '0', STR_PAD_LEFT); ?></span>
                </a>
                <?php endif; ?>
                <?php if ($nextId): ?>
                <a href="studio-episode.php?id=<?php echo $nextId; ?>" class="ep-nav-btn ep-nav-next">
                    <span>Épisode <?php echo str_pad($nextId, 2, '0', STR_PAD_LEFT); ?></span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- SIDEBAR -->
        <div>
            <div class="ep-sidebar-card">
                <div class="ep-sidebar-card-top"></div>
                <div class="ep-sidebar-body">
                    <div class="ep-meta-row">
                        <span class="ep-meta-label">Épisode</span>
                        <span class="ep-meta-val"><?php echo htmlspecialchars($ep['numero']); ?></span>
                    </div>
                    <div class="ep-meta-row">
                        <span class="ep-meta-label">Durée</span>
                        <span class="ep-meta-val"><?php echo htmlspecialchars($ep['duree']); ?></span>
                    </div>
                    <div class="ep-meta-row">
                        <span class="ep-meta-label">Date</span>
                        <span class="ep-meta-val"><?php echo htmlspecialchars($ep['date']); ?></span>
                    </div>
                    <div class="ep-meta-row">
                        <span class="ep-meta-label">Tags</span>
                        <div style="display:flex;flex-wrap:wrap;gap:0.4rem;margin-top:0.25rem;">
                            <?php foreach ($ep['tags'] as $t): ?>
                            <span style="font-size:0.6rem;letter-spacing:0.1em;padding:0.2rem 0.55rem;border-radius:3px;background:rgba(184,151,90,0.08);border:1px solid rgba(184,151,90,0.18);color:var(--gold,#b8975a);"><?php echo htmlspecialchars($t); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.ep-body -->
</div><!-- /.episode-page -->

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-inner">
        <span class="footer-logo">MR<span class="dot">.</span></span>
        <span class="footer-copy">© 2025 — Portfolio Mael Rabah</span>
        <span class="footer-tag">BUT MMI</span>
    </div>
</footer>

<script src="./script.js"></script>
</body>
</html>
