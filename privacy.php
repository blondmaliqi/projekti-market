<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Express Market · Politika e Privatësisë</title>
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

    /* Privacy Content */
    .privacy-content {
      background: white;
      border-radius: 40px;
      padding: 48px;
      margin: 30px 0 60px;
      box-shadow: 0 12px 28px -8px rgba(0,0,0,0.06);
      border: 1px solid #ede5d8;
    }

    .privacy-section {
      margin-bottom: 40px;
    }

    .privacy-section:last-child {
      margin-bottom: 0;
    }

    .privacy-section h2 {
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

    .privacy-section h2 i {
      color: #e7b42c;
      font-size: 26px;
    }

    .privacy-section h3 {
      font-size: 20px;
      color: #1e3a2e;
      margin: 24px 0 16px;
    }

    .privacy-section p {
      color: #3d4e3f;
      margin-bottom: 16px;
    }

    .privacy-section ul, .privacy-section ol {
      margin: 16px 0 16px 24px;
      color: #3d4e3f;
    }

    .privacy-section li {
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

    /* Alkool Warning Box */
    .alkool-warning-box {
      background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
      border-left: 6px solid #e65100;
      padding: 24px 28px;
      border-radius: 20px;
      margin: 30px 0;
    }

    .alkool-warning-box h3 {
      color: #e65100;
      margin-top: 0;
      margin-bottom: 16px;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .alkool-warning-box h3 i {
      font-size: 28px;
    }

    .alkool-warning-box p {
      color: #4e342e;
      margin-bottom: 12px;
    }

    .alkool-warning-box ul {
      color: #4e342e;
    }

    .age-badge {
      display: inline-block;
      background: #e65100;
      color: white;
      padding: 4px 12px;
      border-radius: 30px;
      font-size: 14px;
      font-weight: 700;
      margin-left: 12px;
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
      .privacy-content {
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
    <h1><i class="fas fa-lock" style="color: #e7b42c; margin-right: 12px;"></i> Politika e Privatësisë</h1>
    <p>Ne e marrim seriozisht privatësinë tuaj. Kjo politikë shpjegon se si mbledhim, përdorim dhe mbrojmë të dhënat tuaja personale.</p>
    <div class="last-updated">
      <i class="fas fa-calendar-check"></i> Përditësuar: 1 Janar 2026
    </div>
  </div>

  <!-- Table of Contents -->
  <div class="toc">
    <h3><i class="fas fa-list"></i> Përmbajtja</h3>
    <ul>
      <li><a href="#hyrje"><i class="fas fa-chevron-right"></i> 1. Hyrje</a></li>
      <li><a href="#cfare-mbledhim"><i class="fas fa-chevron-right"></i> 2. Çfarë të dhënash mbledhim</a></li>
      <li><a href="#si-perdorim"><i class="fas fa-chevron-right"></i> 3. Si i përdorim të dhënat</a></li>
      <li><a href="#alkool"><i class="fas fa-chevron-right"></i> 4. Politika për Alkoolin (+18)</a></li>
      <li><a href="#cookies"><i class="fas fa-chevron-right"></i> 5. Cookies dhe Teknologji të Ngjashme</a></li>
      <li><a href="#ndarja"><i class="fas fa-chevron-right"></i> 6. Ndarja e të Dhënave</a></li>
      <li><a href="#siguria"><i class="fas fa-chevron-right"></i> 7. Siguria e të Dhënave</a></li>
      <li><a href="#te-drejtat"><i class="fas fa-chevron-right"></i> 8. Të Drejtat Tuaja</a></li>
      <li><a href="#kontakti"><i class="fas fa-chevron-right"></i> 9. Kontakti</a></li>
    </ul>
  </div>

  <!-- Privacy Content -->
  <div class="privacy-content">
    
    <!-- Section 1 -->
    <section id="hyrje" class="privacy-section">
      <h2><i class="fas fa-info-circle"></i> 1. Hyrje</h2>
      <p>Express Market ("ne", "neve", "tona") është i përkushtuar të mbrojë privatësinë tuaj. Kjo Politikë e Privatësisë shpjegon praktikat tona në lidhje me mbledhjen, përdorimin dhe zbulimin e informacionit tuaj personal kur përdorni faqen tonë të internetit dhe shërbimet tona.</p>
      <p>Duke përdorur shërbimet tona, ju pranoni praktikat e përshkruara në këtë Politikë të Privatësisë.</p>
    </section>

    <!-- Section 2 -->
    <section id="cfare-mbledhim" class="privacy-section">
      <h2><i class="fas fa-database"></i> 2. Çfarë të dhënash mbledhim</h2>
      <p>Ne mbledhim llojet e mëposhtme të informacionit:</p>
      <h3>2.1 Informacion që ju na jepni</h3>
      <ul>
        <li><strong>Të dhënat e llogarisë:</strong> Emri, mbiemri, adresa email, numri i telefonit, fjalëkalimi.</li>
        <li><strong>Të dhënat e porosisë:</strong> Adresa e dorëzimit, detajet e pagesës, historiku i porosive.</li>
        <li><strong>Komunikimi:</strong> Mesazhet që na dërgoni përmes rrjeteve sociale ose numrit të telefonit.</li>
      </ul>
      
    </section>

    <!-- Section 3 -->
    <section id="si-perdorim" class="privacy-section">
      <h2><i class="fas fa-chart-line"></i> 3. Si i përdorim të dhënat tuaja</h2>
      <p>Ne përdorim informacionin tuaj për qëllimet e mëposhtme:</p>
      <ul>
        <li>Për të përpunuar dhe dorëzuar porositë tuaja</li>
        <li>Për të komunikuar me ju në lidhje me porositë, promocionet dhe përditësimet</li>
        <li>Për të përmirësuar dhe personalizuar përvojën tuaj në faqen tonë</li>
        <li>Për të analizuar përdorimin e faqes dhe për të përmirësuar shërbimet tona</li>
        <li>Për të mbrojtur sigurinë dhe integritetin e faqes sonë</li>
        <li>Për të përmbushur detyrimet ligjore</li>
      </ul>
    </section>

    <!-- Section 4 - ALKOOL +18 -->
    <section id="alkool" class="privacy-section">
      <h2><i class="fas fa-wine-bottle"></i> 4. Politika për Alkoolin (+18)</h2>
      
      <div class="alkool-warning-box">
        <h3><i class="fas fa-exclamation-triangle"></i> Njoftim i Rëndësishëm <span class="age-badge">+18</span></h3>
        <p>Express Market shet produkte alkoolike. Në përputhje me ligjet në fuqi, shitja e alkoolit u lejohet vetëm personave mbi 18 vjeç.</p>
      </div>
      
      <h3>4.1 Verifikimi i Moshës</h3>
      <p>Për të blerë produkte alkoolike, ne kërkojmë verifikimin e moshës. Kjo mund të përfshijë:</p>
      <ul>
        <li>Konfirmimin se jeni mbi 18 vjeç përmes një dritareje kërcyese (pop-up) në faqen tonë</li>
        <li>Verifikimin e moshës në momentin e dorëzimit nga stafi ynë (kërkohet letërnjoftim)</li>
        <li>Ruajtjen e konfirmimit të moshës në sesionin e shfletuesit tuaj për 24 orë</li>
      </ul>
      
      <h3>4.2 Të Dhënat e Mbledhura për Alkoolin</h3>
      <p>Kur blini alkool, ne mund të mbledhim dhe ruajmë:</p>
      <ul>
        <li>Konfirmimin se keni konfirmuar moshën mbi 18 vjeç</li>
        <li>Datën dhe orën e konfirmimit</li>
        <li>Historikun e blerjeve të alkoolit</li>
      </ul>
      <p>Këto të dhëna ruhen për qëllime ligjore dhe auditimi, në përputhje me legjislacionin në fuqi.</p>
      
      <h3>4.3 Refuzimi i Shërbimit</h3>
      <p>Express Market rezervon të drejtën të refuzojë shitjen e alkoolit nëse:</p>
      <ul>
        <li>Nuk mund të verifikohet mosha mbi 18 vjeç</li>
        <li>Personi refuzon të tregojë letërnjoftimin në momentin e dorëzimit</li>
        <li>Ka dyshime të arsyeshme se blerësi është nën moshën 18 vjeç</li>
        <li>Blerja do të ishte në shkelje të ligjeve në fuqi</li>
      </ul>
      
      <h3>4.4 Përgjegjësia e Blerësit</h3>
      <p>Duke blerë alkool nga Express Market, ju deklaroni dhe garantoni se:</p>
      <ul>
        <li>Jeni të paktën 18 vjeç</li>
        <li>Nuk po blini alkool për persona nën moshën 18 vjeç</li>
        <li>Do të konsumoni alkoolin në mënyrë të përgjegjshme</li>
      </ul>
      
      <div class="highlight-box">
        <p><i class="fas fa-shield-alt"></i> <strong>Mbrojtja e të Miturve:</strong> Ne jemi të përkushtuar të parandalojmë shitjen e alkoolit personave nën 18 vjeç. Nëse dyshoni se një i mitur ka blerë alkool nga ne, ju lutemi na kontaktoni menjëherë.</p>
      </div>
    </section>

    

    <!-- Section 6 -->
    <section id="ndarja" class="privacy-section">
      <h2><i class="fas fa-share-alt"></i> 5. Ndarja e të Dhënave</h2>
      <p>Ne nuk shesim, tregtojmë ose transferojmë informacionin tuaj personal palëve të treta, përveç rasteve të mëposhtme:</p>
      <ul>
        <li><strong>Ofruesit e shërbimeve:</strong> Kompanitë që na ndihmojnë me përpunimin e pagesave, dorëzimin, marketingun, etj.</li>
        <li><strong>Detyrimet ligjore:</strong> Kur kërkohet nga ligji ose për të mbrojtur të drejtat tona ligjore.</li>
        <li><strong>Transferimi i biznesit:</strong> Në rast të shitjes, bashkimit ose riorganizimit të kompanisë.</li>
      </ul>
    </section>

    <!-- Section 7 -->
    <section id="siguria" class="privacy-section">
      <h2><i class="fas fa-shield-halved"></i> 6. Siguria e të Dhënave</h2>
      <p>Ne zbatojmë masa të përshtatshme teknike dhe organizative për të mbrojtur të dhënat tuaja personale nga aksesi i paautorizuar, humbja, keqpërdorimi ose zbulimi.</p>
      <p>Megjithatë, asnjë metodë e transmetimit në internet ose ruajtjes elektronike nuk është 100% e sigurt. Ne përpiqemi të përdorim mjete të pranueshme komerciale për të mbrojtur informacionin tuaj.</p>
    </section>

    <!-- Section 8 -->
    <section id="te-drejtat" class="privacy-section">
      <h2><i class="fas fa-user-check"></i> 7. Të Drejtat Tuaja</h2>
      <p>Në përputhje me ligjet në fuqi, ju keni të drejtat e mëposhtme:</p>
      <ul>
        <li><strong>E drejta e aksesit:</strong> Të kërkoni një kopje të të dhënave tuaja personale.</li>
        <li><strong>E drejta e korrigjimit:</strong> Të kërkoni korrigjimin e të dhënave të pasakta.</li>
        <li><strong>E drejta e fshirjes:</strong> Të kërkoni fshirjen e të dhënave tuaja ("e drejta për t'u harruar").</li>
        <li><strong>E drejta e kundërshtimit:</strong> Të kundërshtoni përpunimin e të dhënave tuaja.</li>
        <li><strong>E drejta e tërheqjes së pëlqimit:</strong> Të tërhiqni pëlqimin në çdo kohë.</li>
      </ul>
      <p>Për të ushtruar këto të drejta, ju lutemi na kontaktoni në adresën e mëposhtme.</p>
    </section>

    <!-- Section 9 -->
    <section id="kontakti" class="privacy-section">
      <h2><i class="fas fa-address-card"></i> 8. Kontakti</h2>
      <p>Nëse keni pyetje në lidhje me këtë Politikë të Privatësisë ose dëshironi të ushtroni të drejtat tuaja, ju lutemi na kontaktoni:</p>
      <ul>
        <li><i class="fas fa-envelope"></i> Email: expressmarket@gmail.com</li>
        <li><i class="fas fa-phone"></i> Telefon: +383 44 522 777</li>
        <li><i class="fas fa-map-marker-alt"></i> Adresa: Rruga Adem Jashari 12, Gjilan, Kosovë</li>
      </ul>
      <div class="highlight-box">
        <p><i class="fas fa-clock"></i> Ne do t'i përgjigjemi kërkesës suaj brenda 30 ditëve.</p>
      </div>
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
          <li><a href="kontakt.php"><i class="fas fa-chevron-right"></i> Kontakti</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h4>Informacion Ligjor</h4>
        <ul class="footer-links">
          <li><a href="termet.php"><i class="fas fa-shield-alt"></i> Termat dhe Kushtet</a></li>
          <li><a href="privacy.php" style="color: #e7b42c;"><i class="fas fa-lock"></i> Politika e Privatësisë</a></li>
          
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