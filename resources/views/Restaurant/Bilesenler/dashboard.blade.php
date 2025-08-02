@extends('Restaurant.Bilesenler.app')
@section('content')
        <div class="category-tabs">
            <button class="category-tab active" onclick="selectCategory('salon')">İç Salon</button>
            <button class="category-tab" onclick="selectCategory('bahce')">Bahçe</button>
            <button class="category-tab" onclick="selectCategory('bar')">Bar</button>
            <button class="category-tab" onclick="selectCategory('vip')">VIP</button>
            <button class="category-tab" onclick="selectCategory('terras')">Teras</button>
            
            <div class="right-buttons">
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


        <!-- Ayarlar Modal -->


<!-- Büyük Ayarlar Modal -->
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
                    
                    <button class="setting-btn danger" onclick="openSystemReset()">
                        <i class="fa fa-refresh"></i>
                        <div>
                            <strong>Sistem Sıfırlama</strong>
                            <small>Fabrika ayarlarına dön</small>
                        </div>
                    </button>
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

        
        <!-- Ayarlar Modal -->


        <!-- Modern Tables Section -->
        <div class="tables-container">
            <div class="tables-grid" id="tablesGrid">
                <!-- Tables will be loaded here -->
            </div>
        </div>

           <script>
        let currentCategory = 'salon';
        
        // Masa verileri
        const allTables = {
            'salon': [
                { number: 1, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 2, status: 'occupied', price: 1185.50, time: '14:30', waiter: 'Yalçın' },
                { number: 3, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 4, status: 'occupied', price: 3275.75, time: '13:15', waiter: 'Yalçın' },
                { number: 5, status: 'locked', price: 0, time: 'Kilitli', waiter: 'İşlemde' },
                { number: 6, status: 'occupied', price: 57256.00, time: '12:45', waiter: 'Yalçın' },
                { number: 7, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 8, status: 'occupied', price: 695.25, time: '15:20', waiter: 'Yalçın' },
                { number: 9, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 10, status: 'occupied', price: 12380.90, time: '11:30', waiter: 'Yalçın' },
                { number: 11, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 12, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 13, status: 'occupied', price: 2210.40, time: '14:00', waiter: 'Yalçın' },
                { number: 14, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 15, status: 'reserved', price: 0, time: '18:00', waiter: 'Hasan', reservedFor: 'VIP Müşteri' },
                { number: 16, status: 'available', price: 0, time: 'Boş', waiter: '' }
            ],
            'bahce': [
                { number: 17, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 18, status: 'occupied', price: 4320.15, time: '13:00', waiter: 'Yalçın' },
                { number: 19, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 20, status: 'occupied', price: 1555.80, time: '14:15', waiter: 'Yalçın' },
                { number: 21, status: 'reserved', price: 0, time: '19:30', waiter: 'Yalçın', reservedFor: 'Doğum Günü' },
                { number: 22, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 23, status: 'occupied', price: 28585.60, time: '12:30', waiter: 'Yalçın' },
                { number: 24, status: 'available', price: 0, time: 'Boş', waiter: '' }
            ],
            'bar': [
                { number: 25, status: 'occupied', price: 1880.25, time: '15:00', waiter: 'Yalçın' },
                { number: 26, status: 'occupied', price: 2440.90, time: '14:45', waiter: 'Yalçın' },
                { number: 27, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 28, status: 'occupied', price: 1165.75, time: '16:10', waiter: 'Yalçın' },
                { number: 29, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 30, status: 'occupied', price: 1995.50, time: '15:30', waiter: 'Yalçın' }
            ],
            'vip': [
                { number: 31, status: 'occupied', price: 85850.75, time: '13:30', waiter: 'Yalçın' },
                { number: 32, status: 'reserved', price: 0, time: '20:00', waiter: 'Yalçın', reservedFor: 'İş Yemeği' },
                { number: 33, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 34, status: 'occupied', price: 65650.25, time: '14:00', waiter: 'Yalçın' }
            ],
            'terras': [
                { number: 35, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 36, status: 'occupied', price: 2990.45, time: '13:45', waiter: 'Yalçın' },
                { number: 37, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 38, status: 'reserved', price: 0, time: '18:30', waiter: 'Yalçın', reservedFor: 'Aile Yemeği' },
                { number: 39, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 40, status: 'occupied', price: 1885.20, time: '15:15', waiter: 'Yalçın' },
                { number: 41, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 42, status: 'available', price: 0, time: 'Boş', waiter: '' },
                { number: 43, status: 'occupied', price: 2220.90, time: '14:30', waiter: 'Yalçın' },
                { number: 44, status: 'available', price: 0, time: 'Boş', waiter: '' }
            ]
        };

        function selectCategory(category) {
            currentCategory = category;
            
            document.querySelectorAll('.category-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelector(`[onclick="selectCategory('${category}')"]`).classList.add('active');
            
            loadTables(category);
        }

        function loadTables(category) {
            const tablesGrid = document.getElementById('tablesGrid');
            const tables = allTables[category] || [];
            
            tablesGrid.innerHTML = '';
            
            tables.forEach(table => {
                const statusClass = table.status === 'available' ? 'status-available' : 
                                  table.status === 'occupied' ? 'status-occupied' : 
                                  table.status === 'reserved' ? 'status-reserved' : 'status-locked';
                
                const statusText = table.status === 'available' ? 'BOŞ' : 
                                 table.status === 'occupied' ? 'DOLU' : 
                                 table.status === 'reserved' ? 'REZERVE' : 'KİLİTLİ';
                
                const tableCard = document.createElement('a');
                tableCard.className = `table-card ${table.status}`;
                
                // Kilitli masalar tıklanamaz
                if (table.status === 'locked') {
                    tableCard.href = '#';
                    tableCard.onclick = (e) => e.preventDefault();
                } else {
                    tableCard.href = table.status === 'available' ? 'yeni-siparis.html?masa=' + table.number : 'siparis-detay.html?masa=' + table.number;
                }

                // Rezerve masalar için özel içerik
                let priceContent = '';
                if (table.status === 'reserved') {
                    priceContent = `
                        <div class="reserved-info">
                            <div class="reserved-time">
                                <i class="fas fa-clock"></i>
                                ${table.time}
                            </div>
                            <div class="reserved-name">${table.reservedFor || 'Rezerve'}</div>
                        </div>
                    `;
                } else {
                    priceContent = `<div class="table-price">₺${table.price.toLocaleString('tr-TR', {minimumFractionDigits: 2})}</div>`;
                }
                
                tableCard.innerHTML = `
                    <div class="table-content">
                        <div class="table-header">
                            <div class="table-status"></div>
                        </div>
                        <div class="table-number">Masa ${table.number}</div>
                        ${priceContent}
                        <div class="table-footer">
                            <div class="table-time">${table.status === 'reserved' ? 'Rezerve' : table.time}</div>
                            <div class="table-waiter">${table.waiter}</div>
                        </div>
                    </div>
                `;
                
                tablesGrid.appendChild(tableCard);
            });
        }

        window.addEventListener('load', () => {
            loadTables('salon');
        });

        // Model

function openSettings() {
    document.getElementById('settingsModal').classList.add('show');
    document.body.style.overflow = 'hidden'; // Arka planı kaydırmayı engelle
}

function closeSettings() {
    document.getElementById('settingsModal').classList.remove('show');
    document.body.style.overflow = 'auto'; // Kaydırmayı tekrar aktif et
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
function openThemeSettings() {
    alert('Tema ayarları Yakında......');
    closeSettings();
}

function openLanguageSettings() {
    alert('Dil ayarları Yakında......');
    closeSettings();
}

function openNotificationSettings() {
    alert('Bildirim ayarları Yakında......');
    closeSettings();
}

function openDisplaySettings() {
    alert('Ekran ayarları Yakında......');
    closeSettings();
}

function openTableSettings() {
    alert('Masa ayarları Yakında......');
    closeSettings();
}

function openMenuSettings() {
    alert('Menü ayarları Yakında......');
    closeSettings();
}

function openPriceSettings() {
    alert('Fiyat ayarları Yakında......');
    closeSettings();
}

function openTaxSettings() {
    alert('Vergi ayarları Yakında......');
    closeSettings();
}

function openPrinterSettings() {
    alert('Yazıcı ayarları Yakında......');
    closeSettings();
}

function openUserSettings() {
    alert('Kullanıcı yönetimi Yakında......');
    closeSettings();
}

function openBackupSettings() {
    alert('Yedekleme ayarları Yakında......');
    closeSettings();
}

function openSystemReset() {
    if(confirm('Sistem ayarlarını sıfırlamak istediğinizden emin misiniz?')) {
        alert('Sistem sıfırlanıyor...');
        closeSettings();
    }
}

        // Model

    </script>
@endsection