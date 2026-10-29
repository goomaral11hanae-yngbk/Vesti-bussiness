<footer>
<div class="fw">
  <div>
    <div class="fl">VESTI</div>
    <p data-i18n="Дэлхийн алдартай брэндүүдийг нэг дор. Zara, Uniqlo, Pull&amp;Bear, H&amp;M, adidas, Nike, Converse-ийн шинэ цуглуулгыг найдвартай, хурдан хүргэлтээр танд хүргэнэ.">Дэлхийн алдартай брэндүүдийг нэг дор. Zara, Uniqlo, Pull&amp;Bear, H&amp;M, adidas, Nike, Converse-ийн шинэ цуглуулгыг найдвартай, хурдан хүргэлтээр танд хүргэнэ.</p>
    <div class="soc">
      <a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.500" cy="6.500" r=".6"/></svg></a>
      <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24"><path d="M14 8h3V4h-3a4 4 0 00-4 4v3H7v4h3v6h4v-6h3l1-4h-4V8z"/></svg></a>
    </div>
  </div>
  <div>
    <h4 data-i18n="BRANDS">BRANDS</h4>
    @foreach($brands as $b)<a onclick="go('{{ $b['n'] }}')">{{ $b['n'] }}</a>@endforeach
  </div>
  <div>
    <h4 data-i18n="ТУСЛАМЖ">ТУСЛАМЖ</h4>
    <a href="#" data-i18n="Хүргэлтийн мэдээлэл">Хүргэлтийн мэдээлэл</a><a href="#" data-i18n="Буцаалт, солилт">Буцаалт, солилт</a><a href="#" data-i18n="Хэмжээний хүснэгт">Хэмжээний хүснэгт</a><a href="#" data-i18n="Түгээмэл асуулт">Түгээмэл асуулт</a><a href="#" data-i18n="Нууцлалын бодлого">Нууцлалын бодлого</a>
  </div>
  <div>
    <h4 data-i18n="ХОЛБОО БАРИХ">ХОЛБОО БАРИХ</h4>
    <a href="tel:+97699999999">+976 9999 9999</a>
    <a href="mailto:info@vesti.mn">info@vesti.mn</a>
    <p data-i18n="Улаанбаатар хот, Сүхбаатар дүүрэг|Даваа–Ням: 10:00–21:00">Улаанбаатар хот, Сүхбаатар дүүрэг<br>Даваа–Ням: 10:00–21:00</p>
  </div>
</div>
<div class="cp" data-i18n="© 2026 Vesti. Бүх эрх хуулиар хамгаалагдсан.">© 2026 Vesti. Бүх эрх хуулиар хамгаалагдсан.</div>
</footer>
 