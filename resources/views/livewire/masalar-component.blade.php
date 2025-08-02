<div wire:poll.1s="loadData">
    <div class="category-tabs">
        <button wire:click="selectCategory()" 
                class="category-tab {{ is_null($selectedKategori) ? 'active' : '' }}">
            Tümü
        </button>
        
        @foreach($masaKategorileri as $kategori)
            <button wire:click="selectCategory({{ $kategori->id }})" 
                    class="category-tab {{ $selectedKategori == $kategori->id ? 'active' : '' }}">
                {{ $kategori->masakategoriadi }}
            </button>
        @endforeach
        
        <div class="right-buttons">
            <button class="category-tab settings-button">
                {{ $cashierName }} 
            </button>
            <button class="category-tab settings-button" onclick="openSettings()">
                <i class="fa fa-cog"></i>
            </button>
            
            <form method="POST" action="{{ route('restaurant.logout') }}" style="display: inline;">
                @csrf
                <button class="category-tab logout-button" type="submit">
                    <i class="fa fa-sign-out"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Ayarlar Modal (JavaScript ile çalışacak) -->
    <div id="settingsModal" class="modal" style="display: none;">
        <div class="modal-content large-modal">
            <div class="modal-header">
                <h2><i class="fa fa-cog"></i> Sistem Ayarları</h2>
                <span class="close" onclick="closeSettings()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="settings-grid">
                    <!-- Sol Kolon -->
                    <div class="settings-column">
                        <h3>Genel Ayarlar</h3>
                        <button class="setting-btn" onclick="openThemeSettings()">
                            <i class="fa fa-palette"></i>
                            <div>
                                <strong>Tema Ayarları</strong>
                                <small>Renk ve görünüm ayarları</small>
                            </div>
                        </button>
                        
                        <button class="setting-btn" onclick="openLanguageSettings()">
                            <i class="fa fa-language"></i>
                            <div>
                                <strong>Dil Ayarları</strong>
                                <small>Sistem dili ve bölge</small>
                            </div>
                        </button>
                        
                        <button class="setting-btn" onclick="openNotificationSettings()">
                            <i class="fa fa-bell"></i>
                            <div>
                                <strong>Bildirim Ayarları</strong>
                                <small>Ses ve görsel bildirimler</small>
                            </div>
                        </button>
                        
                        <button class="setting-btn" onclick="openDisplaySettings()">
                            <i class="fa fa-desktop"></i>
                            <div>
                                <strong>Ekran Ayarları</strong>
                                <small>Çözünürlük ve görüntü</small>
                            </div>
                        </button>
                    </div>
                    
                    <!-- Orta Kolon -->
                    <div class="settings-column">
                        <h3>Restoran Ayarları</h3>
                        <button class="setting-btn" onclick="openTableSettings()">
                            <i class="fa fa-table"></i>
                            <div>
                                <strong>Masa Ayarları</strong>
                                <small>Masa düzeni ve özellikleri</small>
                            </div>
                        </button>
                        
                        <button class="setting-btn" onclick="openMenuSettings()">
                            <i class="fa fa-cutlery"></i>
                            <div>
                                <strong>Menü Ayarları</strong>
                                <small>Kategoriler ve ürünler</small>
                            </div>
                        </button>
                        
                        <button class="setting-btn" onclick="openPriceSettings()">
                            <i class="fa fa-money"></i>
                            <div>
                                <strong>Fiyat Ayarları</strong>
                                <small>Para birimi ve fiyatlar</small>
                            </div>
                        </button>
                        
                        <button class="setting-btn" onclick="openTaxSettings()">
                            <i class="fa fa-percent"></i>
                            <div>
                                <strong>Vergi Ayarları</strong>
                                <small>KDV ve hizmet bedeli</small>
                            </div>
                        </button>
                    </div>
                    
                    <!-- Sağ Kolon -->
                    <div class="settings-column">
                        <h3>Sistem Yönetimi</h3>
                        <button class="setting-btn" onclick="openPrinterSettings()">
                            <i class="fa fa-print"></i>
                            <div>
                                <strong>Yazıcı Ayarları</strong>
                                <small>Fiş ve mutfak yazıcıları</small>
                            </div>
                        </button>
                        
                        <button class="setting-btn" onclick="openUserSettings()">
                            <i class="fa fa-users"></i>
                            <div>
                                <strong>Kullanıcı Yönetimi</strong>
                                <small>Kasiyerler ve yetkiler</small>
                            </div>
                        </button>
                        
                        <button class="setting-btn" onclick="openBackupSettings()">
                            <i class="fa fa-database"></i>
                            <div>
                                <strong>Yedekleme</strong>
                                <small>Veri yedekleme ve geri yükleme</small>
                            </div>
                        </button>
                        
                        <a href="{{ route('restaurant.clear-session') }}" class="setting-btn danger" style="text-decoration: none !important;">
                            <i class="fa fa-refresh"></i>
                            <div>
                                <strong>Sistem Sıfırlama</strong>
                                <small>Kalıcı olarak çıkış yap</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-secondary" onclick="closeSettings()">
                    <i class="fa fa-times"></i> Kapat
                </button>
            </div>
        </div>
    </div>

    <!-- Modern Tables Section -->
    <div class="tables-container">
        <div class="tables-grid" id="tablesGrid">
            @forelse($masalar as $masa)
                @php
                    // Masa durumunu rezervasyon_id ve adisyon_id'ye göre belirle
                    $durum = $masa->computed_durum ?? 'bos';
                    
                    $statusClass = match($durum) {
                        'bos' => 'available',
                        'dolu' => 'occupied', 
                        'rezerve' => 'reserved',
                        'kilitli' => 'locked',
                        default => 'available'
                    };
                    
                    $statusText = match($durum) {
                        'bos' => 'BOŞ',
                        'dolu' => 'DOLU',
                        'rezerve' => 'REZERVE',
                        'kilitli' => 'KİLİTLİ',
                        default => 'BOŞ'
                    };
                    
                    // Toplam tutarı adisyon'dan al
                    $toplamTutar = $masa->adisyon ? $masa->adisyon->toplam_tutar : 0;
                @endphp
                
                <a href="{{ $durum === 'bos' ? '#yeni-siparis?masa=' . $masa->id : '#siparis-detay?masa=' . $masa->id }}" 
                   class="table-card {{ $statusClass }}">
                    <div class="table-content">
                        <div class="table-header">
                            <div class="table-status"></div>
                        </div>
                        <div class="table-number">{{ $masa->masaadi }}</div>
                        
                        @if($durum === 'rezerve')
                            <div class="reserved-info">
                                <div class="reserved-time">
                                    <i class="fas fa-clock"></i>
                                    {{ $masa->rezervasyon ? $masa->rezervasyon->saat : '18:00' }}
                                </div>
                                <div class="reserved-name">{{ $masa->rezervasyon ? $masa->rezervasyon->musteri_adi : 'Rezerve' }}</div>
                            </div>
                        @else
                            <div class="table-price">₺{{ number_format($toplamTutar, 2, ',', '.') }}</div>
                        @endif
                        
                        <div class="table-footer">
                            <div class="table-time">
                                @if($durum === 'rezerve')
                                    Rezerve
                                @elseif($durum === 'dolu')
                                    {{ $masa->adisyon ? $masa->adisyon->created_at->format('H:i') : 'Dolu' }}
                                @else
                                    Boş
                                @endif
                            </div>
                            <div class="table-waiter">
                                {{ $masa->adisyon ? ($masa->adisyon->garson_adi ?? '') : '' }}
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Henüz masa bulunmuyor.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        // Sadece ayarlar modal'ı için JavaScript (Livewire ile değiştirilmeyen kısım)
        function openSettings() {
            document.getElementById('settingsModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeSettings() {
            document.getElementById('settingsModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Sayfa yüklendiğinde modal kapalı olsun
        document.addEventListener('DOMContentLoaded', function() {
            closeSettings();
        });

        // ESC tuşu ile kapatma
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSettings();
            }
        });

        // Modal dışına tıklanınca kapatma
        window.onclick = function(event) {
            let modal = document.getElementById('settingsModal');
            if (event.target == modal) {
                closeSettings();
            }
        }

        // Ayar butonları için fonksiyonlar
        function openThemeSettings() { alert('Tema ayarları Yakında......'); closeSettings(); }
        function openLanguageSettings() { alert('Dil ayarları Yakında......'); closeSettings(); }
        function openNotificationSettings() { alert('Bildirim ayarları Yakında......'); closeSettings(); }
        function openDisplaySettings() { alert('Ekran ayarları Yakında......'); closeSettings(); }
        function openTableSettings() { alert('Masa ayarları Yakında......'); closeSettings(); }
        function openMenuSettings() { alert('Menü ayarları Yakında......'); closeSettings(); }
        function openPriceSettings() { alert('Fiyat ayarları Yakında......'); closeSettings(); }
        function openTaxSettings() { alert('Vergi ayarları Yakında......'); closeSettings(); }
        function openPrinterSettings() { alert('Yazıcı ayarları Yakında......'); closeSettings(); }
        function openUserSettings() { alert('Kullanıcı yönetimi Yakında......'); closeSettings(); }
        function openBackupSettings() { alert('Yedekleme ayarları Yakında......'); closeSettings(); }
    </script>
</div>