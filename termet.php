<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Express Market · Termat dhe Kushtet</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #fff;
      color: #1e1e1e;
      line-height: 1.6;
    }

    .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 0 24px;
    }

    /* Logo në krye të faqes */
    .logo-top {
      text-align: center;
      padding: 30px 0 20px;
    }

    .logo-top a {
      display: inline-block;
      text-decoration: none;
      transition: transform 0.2s;
    }

    .logo-top a:hover {
      transform: scale(1.02);
    }

    .logo-img {
      height: 90px;
      width: auto;
      max-width: 200px;
      object-fit: contain;
    }

    /* Butoni Kthehu */
    .back-link {
      text-align: center;
      margin: 10px 0 20px;
    }

    .back-link a {
      color: #6b4f2c;
      text-decoration: none;
      font-size: 14px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: color 0.2s;
    }

    .back-link a:hover {
      color: #e7b42c;
    }

    /* Page Header */
    .page-header {
      padding: 20px 0 30px;
      text-align: center;
    }

    .page-header h1 {
      font-family: 'Playfair Display', serif;
      font-size: 42px;
      color: #1e3a2e;
      margin-bottom: 16px;
    }

    .page-header p {
      color: #5f6b5e;
      font-size: 16px;
    }

    .last-updated {
      display: inline-block;
      background: #fef7ec;
      padding: 8px 20px;
      border-radius: 30px;
      font-size: 14px;
      color: #6b4f2c;
      margin-top: 16px;
    }

    /* Terms Content */
    .terms-content {
      background: white;
      border-radius: 40px;
      padding: 48px;
      margin: 30px 0 60px;
      box-shadow: 0 12px 28px -8px rgba(0,0,0,0.06);
      border: 1px solid #ede5d8;
    }

    .terms-section {
      margin-bottom: 40px;
    }

    .terms-section:last-child {
      margin-bottom: 0;
    }

    .terms-section h2 {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      color: #1e3a2e;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      border-bottom: 2px solid #f0e4d5;
      padding-bottom: 12px;
    }

    .terms-section h2 i {
      color: #e7b42c;
      font-size: 26px;
    }

    .terms-section h3 {
      font-size: 20px;
      color: #1e3a2e;
      margin: 24px 0 16px;
    }

    .terms-section p {
      color: #3d4e3f;
      margin-bottom: 16px;
    }

    .terms-section ul, .terms-section ol {
      margin: 16px 0 16px 24px;
      color: #3d4e3f;
    }

    .terms-section li {
      margin-bottom: 10px;
    }

    .highlight-box {
      background: #fef7ec;
      border-left: 4px solid #e7b42c;
      padding: 20px 24px;
      border-radius: 16px;
      margin: 24px 0;
    }

    .highlight-box p {
      margin-bottom: 0;
    }

    .highlight-box i {
      color: #e7b42c;
      margin-right: 10px;
    }

    /* Table of Contents */
    .toc {
      background: #faf6ef;
      border-radius: 24px;
      padding: 24px 32px;
      margin-bottom: 40px;
    }

    .toc h3 {
      font-size: 20px;
      margin-bottom: 16px;
      color: #1e3a2e;
    }

    .toc ul {
      list-style: none;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 12px 24px;
    }

    .toc li {
      margin-bottom: 8px;
    }

    .toc a {
      color: #3d4e3f;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: color 0.2s;
    }

    .toc a i {
      color: #e7b42c;
      font-size: 12px;
    }

    .toc a:hover {
      color: #e7b42c;
    }

    /* Footer */
    .footer {
      background: #1e2b24;
      color: #e4d9cd;
      padding: 50px 0 20px;
      margin-top: 60px;
      border-radius: 48px 48px 0 0;
    }

    .footer-top {
      display: grid;
      grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
      gap: 40px;
      margin-bottom: 40px;
    }

    .footer-column h4 {
      color: white;
      font-size: 18px;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .footer-column p {
      margin-bottom: 10px;
      color: #b8c4b8;
    }

    .footer-column i {
      color: #e7b42c;
      width: 20px;
      margin-right: 8px;
    }

    .footer-links {
      list-style: none;
    }

    .footer-links li {
      margin-bottom: 12px;
    }

    .footer-links a {
      color: #b8c4b8;
      text-decoration: none;
      transition: color 0.2s;
      display: flex;
      align-items: center;
    }

    .footer-links a i {
      font-size: 12px;
      margin-right: 10px;
    }

    .footer-links a:hover {
      color: #e7b42c;
    }

    .footer-social {
      display: flex;
      gap: 12px;
      margin-bottom: 20px;
    }

    .footer-social a {
      background: #2a3a30;
      width: 45px;
      height: 45px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #e4d9cd;
      font-size: 20px;
      text-decoration: none;
      transition: all 0.2s;
    }

    .footer-social a:hover {
      background: #e7b42c;
      color: #1e2b24;
      transform: translateY(-3px);
    }

    .payment-icons {
      display: flex;
      gap: 12px;
      font-size: 28px;
      color: #b8c4b8;
    }

    .footer-bottom {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 30px;
      border-top: 1px solid #3a4a3e;
      font-size: 14px;
      color: #9aab9a;
      flex-wrap: wrap;
      gap: 16px;
    }

    .footer-bottom-links {
      display: flex;
      gap: 16px;
      align-items: center;
    }

    .footer-bottom-links a {
      color: #9aab9a;
      text-decoration: none;
      transition: color 0.2s;
    }

    .footer-bottom-links a:hover {
      color: #e7b42c;
    }

    /* Responsive */
    @media (max-width: 1000px) {
      .footer-top {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .toc ul {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 800px) {
      .terms-content {
        padding: 32px 24px;
      }
    }

    @media (max-width: 600px) {
      .footer-top {
        grid-template-columns: 1fr;
      }
      
      .footer-bottom {
        flex-direction: column;
        text-align: center;
      }
      
      .page-header h1 {
        font-size: 36px;
      }
      
      .logo-img {
        height: 70px;
      }
    }
  </style>
</head>
<body>

<main class="container">
  <!-- Logo në krye -->
  <div class="logo-top">
    <a href="index.php">
      <img src="expressmarketlogo.png" alt="Express Market" class="logo-img">
    </a>
  </div>
  
  <!-- Butoni Kthehu -->
  <div class="back-link">
    <a href="index.php">
      <i class="fas fa-arrow-left"></i> Kthehu në kryefaqe
    </a>
  </div>

  <div class="page-header">
    <h1><i class="fas fa-file-contract" style="color: #e7b42c; margin-right: 12px;"></i> Termat dhe Kushtet</h1>
    <p>Ju lutemi lexoni me kujdes termat dhe kushtet tona përpara se të përdorni shërbimet tona.</p>
    <div class="last-updated">
      <i class="fas fa-calendar-check"></i> Përditësuar: 1 Janar 2026
    </div>
  </div>

  <!-- Table of Contents -->
  <div class="toc">
    <h3><i class="fas fa-list"></i> Përmbajtja</h3>
    <ul>
      <li><a href="#pranimi"><i class="fas fa-chevron-right"></i> 1. Pranimi i Termave</a></li>
      <li><a href="#sherbimet"><i class="fas fa-chevron-right"></i> 2. Shërbimet Tona</a></li>
      <li><a href="#llogaria"><i class="fas fa-chevron-right"></i> 3. Llogaria e Përdoruesit</a></li>
      <li><a href="#porosite"><i class="fas fa-chevron-right"></i> 4. Porositë dhe Pagesat</a></li>
      <li><a href="#dorezimi"><i class="fas fa-chevron-right"></i> 5. Dorëzimi dhe Transporti</a></li>
      <li><a href="#kthimi"><i class="fas fa-chevron-right"></i> 6. Kthimi dhe Rimbursimi</a></li>
      <li><a href="#cmimet"><i class="fas fa-chevron-right"></i> 7. Çmimet dhe Pagesat</a></li>
      <li><a href="#pergjegjesia"><i class="fas fa-chevron-right"></i> 8. Përgjegjësia</a></li>
      <li><a href="#pronesia"><i class="fas fa-chevron-right"></i> 9. Pronësia Intelektuale</a></li>
      <li><a href="#ndryshime"><i class="fas fa-chevron-right"></i> 10. Ndryshime të Termave</a></li>
      <li><a href="#ligji"><i class="fas fa-chevron-right"></i> 11. Ligji në Fuqi</a></li>
      <li><a href="#kontakti"><i class="fas fa-chevron-right"></i> 12. Kontakti</a></li>
    </ul>
  </div>

  <!-- Terms Content -->
  <div class="terms-content">
    
    <!-- Section 1 -->
    <section id="pranimi" class="terms-section">
      <h2><i class="fas fa-check-circle"></i> 1. Pranimi i Termave</h2>
      <p>Duke përdorur faqen e internetit Express Market dhe shërbimet tona, ju pranoni të jeni të lidhur nga këto Terma dhe Kushte. Nëse nuk jeni dakord me ndonjë pjesë të këtyre termave, ju lutemi mos përdorni shërbimet tona.</p>
      <p>Express Market rezervon të drejtën të ndryshojë këto terma në çdo kohë. Përdorimi i vazhdueshëm i shërbimeve tona pas çdo ndryshimi përbën pranimin tuaj të termave të reja.</p>
    </section>

    <!-- Section 2 -->
    <section id="sherbimet" class="terms-section">
      <h2><i class="fas fa-store"></i> 2. Shërbimet Tona</h2>
      <p>Express Market ofron shërbime të shitjes me pakicë të produkteve ushqimore dhe sendeve të tjera të konsumit të përditshëm. Shërbimet tona përfshijnë:</p>
      <ul>
        <li>Blerje në dyqanin tonë fizik në Gjilan</li>
        <li>Porosi online përmes faqes sonë të internetit</li>
        <li>Shërbim të dorëzimit në shtëpi brenda zonës së shërbimit</li>
        <li>Shërbim të klientit dhe mbështetje</li>
      </ul>
    </section>

    <!-- Section 3 -->
    <section id="llogaria" class="terms-section">
      <h2><i class="fas fa-user-circle"></i> 3. Llogaria e Përdoruesit</h2>
      <p>Për të përdorur disa shërbime të Express Market, mund t'ju kërkohet të krijoni një llogari. Ju jeni përgjegjës për:</p>
      <ul>
        <li>Ruajtjen e konfidencialitetit të kredencialeve të llogarisë suaj</li>
        <li>Të gjitha aktivitetet që ndodhin nën llogarinë tuaj</li>
        <li>Njoftimin e menjëhershëm të Express Market për çdo përdorim të paautorizuar</li>
      </ul>
      <div class="highlight-box">
        <p><i class="fas fa-shield-alt"></i> <strong>Siguria:</strong> Ne nuk do t'ju kërkojmë kurrë fjalëkalimin tuaj me email apo telefon. Raportoni menjëherë çdo aktivitet të dyshimtë.</p>
      </div>
    </section>

    <!-- Section 4 -->
    <section id="porosite" class="terms-section">
      <h2><i class="fas fa-shopping-cart"></i> 4. Porositë dhe Pagesat</h2>
      <p>Të gjitha porositë janë subjekt i disponueshmërisë së produkteve. Express Market rezervon të drejtën të:</p>
      <ul>
        <li>Refuzojë ose anulojë çdo porosi për çfarëdo arsye</li>
        <li>Kufizojë sasitë e produkteve për porosi</li>
        <li>Ndryshojë ose ndërpresë produktet në çdo kohë</li>
      </ul>
      <p>Pas vendosjes së porosisë, do të merrni një email konfirmimi me detajet e porosisë suaj.</p>
    </section>

    <!-- Section 5 -->
    <section id="dorezimi" class="terms-section">
      <h2><i class="fas fa-truck"></i> 5. Dorëzimi dhe Transporti</h2>
      <p>Express Market ofron shërbim dorëzimi brenda zonës së shërbimit. Kushtet e dorëzimit përfshijnë:</p>
      <ul>
        <li>Dorëzimi brenda 30-60 minutave për porositë në Gjilan</li>
        <li>Transport falas për porosi mbi 35€</li>
        <li>Tarifë transporti 5€ për porosi nën 35€</li>
        <li>Dorëzimi bëhet në adresën e specifikuar nga ju gjatë porosisë</li>
      </ul>
    </section>

    <!-- Section 6 -->
    <section id="kthimi" class="terms-section">
      <h2><i class="fas fa-undo-alt"></i> 6. Kthimi dhe Rimbursimi</h2>
      <p>Politika jonë e kthimit dhe rimbursimit përfshin:</p>
      <ul>
        <li>Produktet mund të kthehen brenda 24 orëve nga momenti i blerjes</li>
        <li>Produkti duhet të jetë në gjendje origjinale dhe i pahapur</li>
        <li>Duhet të paraqisni faturën origjinale të blerjes</li>
        <li>Rimbursimi bëhet me të njëjtën mënyrë pagese të përdorur</li>
        <li>Produktet e freskëta (fruta, perime, bulmet) nuk kthehen për arsye higjienike</li>
      </ul>
    </section>

    <!-- Section 7 -->
    <section id="cmimet" class="terms-section">
      <h2><i class="fas fa-tag"></i> 7. Çmimet dhe Pagesat</h2>
      <p>Të gjitha çmimet janë në Euro (€) dhe përfshijnë TVSH-në. Ne pranojmë mënyrat e mëposhtme të pagesës:</p>
      <ul>
        <li>Para në dorë (vetëm për porositë me dorëzim)</li>
        <li>Kartë krediti/debiti në dyqan</li>
        
      </ul>
    </section>

    <!-- Section 8 -->
    <section id="pergjegjesia" class="terms-section">
      <h2><i class="fas fa-balance-scale"></i> 8. Kufizimi i Përgjegjësisë</h2>
      <p>Express Market nuk mban përgjegjësi për:</p>
      <ul>
        <li>Dëme indirekte, të rastësishme ose pasuese</li>
        <li>Vonesa në dorëzim për shkaqe jashtë kontrollit tonë</li>
        <li>Cilësinë e produkteve pas hapjes ose përdorimit jo të duhur</li>
        <li>Reaksione alergjike ndaj produkteve</li>
      </ul>
    </section>

    <!-- Section 9 -->
    <section id="pronesia" class="terms-section">
      <h2><i class="fas fa-copyright"></i> 9. Pronësia Intelektuale</h2>
      <p>Të gjitha përmbajtjet në faqen e internetit Express Market, duke përfshirë tekstin, grafikën, logot, ikonat, imazhet dhe softuerin, janë pronë e Express Market dhe mbrohen nga ligjet e të drejtave të autorit.</p>
    </section>

    <!-- Section 10 -->
    <section id="ndryshime" class="terms-section">
      <h2><i class="fas fa-edit"></i> 10. Ndryshime të Termave</h2>
      <p>Express Market rezervon të drejtën të ndryshojë këto Terma dhe Kushte në çdo kohë. Ndryshimet hyjnë në fuqi menjëherë pas publikimit në këtë faqe. Përdorimi i vazhdueshëm i shërbimeve tona pas ndryshimeve përbën pranimin e termave të reja.</p>
    </section>

    <!-- Section 11 -->
    <section id="ligji" class="terms-section">
      <h2><i class="fas fa-gavel"></i> 11. Ligji në Fuqi</h2>
      <p>Këto Terma dhe Kushte rregullohen dhe interpretohen në përputhje me ligjet e Republikës së Kosovës. Çdo mosmarrëveshje që lind nga këto terma do të jetë subjekt i juridiksionit ekskluziv të gjykatave të Kosovës.</p>
    </section>

    <!-- Section 12 -->
    <section id="kontakti" class="terms-section">
      <h2><i class="fas fa-phone-alt"></i> 12. Kontakti</h2>
      <p>Për çdo pyetje në lidhje me këto Terma dhe Kushte, ju lutemi na kontaktoni:</p>
      <ul>
        <li><i class="fas fa-envelope"></i> Email: expressmarket@gmail.com</li>
        <li><i class="fas fa-phone"></i> Telefon: +383 44 522 777</li>
        <li><i class="fas fa-map-marker-alt"></i> Adresa: Rruga Adem Jashari 12, Gjilan, Kosovë</li>
      </ul>
    </section>

  </div>
</main>

<footer class="footer">
  <div class="container">
    <div class="footer-top">
      <div class="footer-column">
        <div class="logo-text" style="font-size: 32px; margin-bottom: 16px; color: #e7b42c;">Express Market</div>
        <p><i class="fas fa-map-marker-alt"></i> Rruga Adem Jashari 12, Gjilan</p>
        <p><i class="fas fa-phone"></i> +383 44 522 777</p>
        <p><i class="fas fa-envelope"></i> expressmarket@gmail.com</p>
      </div>
      
      <div class="footer-column">
        <h4>Lidhje të Shpejta</h4>
        <ul class="footer-links">
          <li><a href="index.php"><i class="fas fa-chevron-right"></i> Kryefaqja</a></li>
          <li><a href="produktet.php"><i class="fas fa-chevron-right"></i> Produktet</a></li>
          <li><a href="navizitoni.php"><i class="fas fa-chevron-right"></i> Na Vizitoni</a></li>
          <li><a href="rrethnesh.php"><i class="fas fa-chevron-right"></i> Rreth Nesh</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h4>Informacion Ligjor</h4>
        <ul class="footer-links">
          <li><a href="termet.php" style="color: #e7b42c;"><i class="fas fa-shield-alt"></i> Termat dhe Kushtet</a></li>
          <li><a href="privacy.php"><i class="fas fa-lock"></i> Politika e Privatësisë</a></li>
          
        </ul>
      </div>
      
      <div class="footer-column">
        <h4>Na Ndiqni</h4>
        <div class="footer-social">
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-whatsapp"></i></a>
          <a href="#"><i class="fab fa-tiktok"></i></a>
        </div>
        <h4 style="margin-top: 24px;">Pagesa të Sigurta</h4>
        <div class="payment-icons">
          <i class="fab fa-cc-visa"></i>
          <i class="fab fa-cc-mastercard"></i>
          <i class="fas fa-money-bill-wave"></i>
        </div>
      </div>
    </div>
    
    <div class="footer-bottom">
      <p>© 2026 Express Market — Të gjitha të drejtat e rezervuara</p>
      <div class="footer-bottom-links">
        <a href="termet.php">Termat dhe Kushtet</a>
        <span>|</span>
        <a href="privacy.php">Politika e Privatësisë</a>
      </div>
    </div>
  </div>
</footer>

<script>
  (function(){
    // Smooth scroll for anchor links
    document.querySelectorAll('.toc a').forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        const targetId = link.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
          targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });
  })();
</script>
</body>
</html>