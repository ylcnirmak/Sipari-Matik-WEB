@extends('Restaurant.Bilesenler.app')
<style>
.container {
   display: flex;
   height: 100vh;
   gap: 5px;
   padding: 5px;
}

.quick-actions-panel {
   flex: 0.2;
   padding: 0;
   display: flex;
   flex-direction: column;
   gap: 5px;
}

.quick-btn {
   padding: 0;
   border: none;
   border-radius: 8px;
   font-weight: 500;
   cursor: pointer;
   transition: all 0.2s ease;
   display: flex;
   flex-direction: column;
   align-items: center;
   justify-content: center;
   gap: 4px;
   font-size: 10px;
   height: 70px;
   width: 100%;
   box-shadow: 0 1px 3px rgba(0,0,0,0.1);
   position: relative;
}

.quick-btn:hover {
   transform: translateY(-1px);
   box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

.quick-btn i {
   font-size: 16px;
}

.products-panel {
   flex: 2.5;
   background: rgba(255, 255, 255, 0.95);
   border-radius: 12px;
   backdrop-filter: blur(10px);
   display: flex;
   flex-direction: column;
   overflow: hidden;
   box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.panel-header {
   padding: 20px;
   background: #2563eb;
   color: white;
   display: flex;
   align-items: center;
   justify-content: space-between;
}

.panel-title {
   font-size: 20px;
   font-weight: 600;
   display: flex;
   align-items: center;
   gap: 10px;
}

.masa-badge {
   background: rgba(255, 255, 255, 0.2);
   padding: 5px 12px;
   border-radius: 8px;
   font-size: 14px;
   font-weight: 500;
}

.back-btn {
   background: rgba(255, 255, 255, 0.2);
   border: none;
   color: white;
   padding: 8px 16px;
   border-radius: 8px;
   cursor: pointer;
   font-weight: 500;
   transition: all 0.2s ease;
}

.back-btn:hover {
   background: rgba(255, 255, 255, 0.3);
}

.categories-section {
   padding: 20px;
   border-bottom: 1px solid #e2e8f0;
}

.categories-grid {
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
   gap: 10px;
}

.category-btn {
   background: #f8fafc;
   border: 1px solid #e2e8f0;
   border-radius: 8px;
   padding: 12px 8px;
   cursor: pointer;
   transition: all 0.2s ease;
   text-align: center;
   font-weight: 500;
   color: #4a5568;
   font-size: 13px;
}

.category-btn.active {
   background: #2563eb;
   color: white;
   border-color: #2563eb;
}

.category-btn:hover {
   background: #e2e8f0;
   border-color: #cbd5e0;
}

.category-btn.active:hover {
   background: #1d4ed8;
}

.products-section {
   flex: 1;
   padding: 20px;
   overflow-y: auto;
}

.products-grid {
   display: grid;
   grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
   gap: 15px;
}

.product-card {
   background: white;
   border-radius: 8px;
   padding: 15px;
   cursor: pointer;
   transition: all 0.2s ease;
   box-shadow: 0 1px 3px rgba(0,0,0,0.1);
   border: 1px solid #e2e8f0;
}

.product-card:hover {
   transform: translateY(-2px);
   box-shadow: 0 4px 12px rgba(0,0,0,0.15);
   border-color: #2563eb;
}

.product-image {
   height: 80px;
   background: #f8fafc;
   border-radius: 8px;
   display: flex;
   align-items: center;
   justify-content: center;
   font-size: 32px;
   margin-bottom: 10px;
   border: 1px solid #e2e8f0;
}

.product-name {
   font-weight: 600;
   color: #2d3748;
   margin-bottom: 5px;
   font-size: 14px;
}

.product-price {
   font-weight: 700;
   color: #2563eb;
   font-size: 16px;
}

.order-panel {
   flex: 1;
   background: rgba(255, 255, 255, 0.95);
   border-radius: 12px;
   backdrop-filter: blur(10px);
   display: flex;
   flex-direction: column;
   overflow: hidden;
   box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.order-header {
   padding: 20px;
   background: #2563eb;
   color: white;
   text-align: center;
}

.order-header h2 {
   font-size: 18px;
   font-weight: 600;
}

.order-items {
   flex: 1;
   padding: 15px;
   overflow-y: auto;
}

.order-item {
   background: #f8fafc;
   border-radius: 8px;
   padding: 15px;
   margin-bottom: 5px;
   border: 1px solid #e2e8f0;
}

.item-header {
   display: flex;
   justify-content: space-between;
   align-items: center;
   margin-bottom: 10px;
}

.item-name {
   font-weight: 600;
   color: #2d3748;
   font-size: 14px;
}

.item-price {
   font-weight: 700;
   color: #2563eb;
   font-size: 14px;
}

.item-controls {
   display: flex;
   align-items: center;
   justify-content: space-between;
}

.quantity-controls {
   display: flex;
   align-items: center;
   gap: 10px;
}

.qty-btn {
   width: 30px;
   height: 30px;
   border-radius: 6px;
   border: 1px solid #e2e8f0;
   background: white;
   color: #4a5568;
   font-weight: 600;
   cursor: pointer;
   transition: all 0.2s ease;
}

.qty-btn:hover {
   background: #f8fafc;
   border-color: #cbd5e0;
}

.qty-value {
   font-weight: 600;
   color: #2d3748;
   min-width: 20px;
   text-align: center;
}

.remove-btn {
   background: #fee2e2;
   color: #dc2626;
   border: 1px solid #fecaca;
   padding: 6px 10px;
   border-radius: 6px;
   cursor: pointer;
   font-size: 12px;
   font-weight: 500;
   transition: all 0.2s ease;
}

.remove-btn:hover {
   background: #fecaca;
}

.order-summary {
   padding: 20px;
   border-top: 1px solid #e2e8f0;
   background: #f8fafc;
}

.summary-row {
   display: flex;
   justify-content: space-between;
   margin-bottom: 8px;
   font-size: 14px;
   color: #4a5568;
}

.total-row {
   font-weight: 700;
   font-size: 16px;
   color: #2d3748;
   margin-top: 10px;
   padding-top: 10px;
   border-top: 1px solid #e2e8f0;
}

.total-price {
   color: #2563eb;
}

.action-buttons {
   padding: 15px;
   display: grid;
   grid-template-columns: 1fr 1fr 1fr;
   gap: 8px;
   height: 80px;
}

.action-btn {
   padding: 0;
   border: none;
   border-radius: 8px;
   font-weight: 500;
   cursor: pointer;
   transition: all 0.2s ease;
   display: flex;
   flex-direction: column;
   align-items: center;
   justify-content: center;
   gap: 4px;
   font-size: 10px;
   width: 100%;
   height: 100%;
   box-shadow: 0 1px 3px rgba(0,0,0,0.1);
   position: relative;
}

.action-btn:hover {
   transform: translateY(-1px);
   box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

.action-btn i {
   font-size: 14px;
}

.quick-btn.locked, .action-btn.locked {
   background: #9ca3af !important;
   color: #6b7280 !important;
   cursor: not-allowed;
   opacity: 0.6;
}

.quick-btn.locked:hover, .action-btn.locked:hover {
   transform: none;
   box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.quick-btn.locked::before, .action-btn.locked::before {
   content: '\f023';
   font-family: 'Font Awesome 6 Free';
   font-weight: 900;
   position: absolute;
   top: 4px;
   right: 4px;
   font-size: 10px;
   color: #ef4444;
   background: white;
   border-radius: 50%;
   width: 16px;
   height: 16px;
   display: flex;
   align-items: center;
   justify-content: center;
   box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}

.primary-btn {
   background: #2563eb;
   color: white;
   border: 1px solid #2563eb;
}

.primary-btn:hover {
   background: #1d4ed8;
}

.success-btn {
   background: #059669;
   color: white;
   border: 1px solid #059669;
}

.success-btn:hover {
   background: #047857;
}

.warning-btn {
   background: #d97706;
   color: white;
   border: 1px solid #d97706;
}

.warning-btn:hover {
   background: #b45309;
}

.danger-btn {
   background: #dc2626;
   color: white;
   border: 1px solid #dc2626;
}

.danger-btn:hover {
   background: #b91c1c;
}

.info-btn {
   background: #0891b2;
   color: white;
   border: 1px solid #0891b2;
}

.info-btn:hover {
   background: #0e7490;
}

.empty-order {
   display: flex;
   flex-direction: column;
   align-items: center;
   justify-content: center;
   height: 200px;
   color: #a0aec0;
   text-align: center;
}

.empty-order-icon {
   font-size: 48px;
   margin-bottom: 10px;
}

@media (max-width: 1024px) {
   .container {
       flex-direction: column;
       height: auto;
       min-height: 100vh;
   }
   
   .products-panel {
       flex: none;
       height: 60vh;
   }
   
   .order-panel {
       flex: none;
       height: 40vh;
   }
   
   .categories-grid {
       grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
   }
   
   .products-grid {
       grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
   }
}
</style>

@section('content')
<div class="container">
    <div class="products-panel">
        <div class="panel-header">
            <div class="panel-title">
                <i class="fas fa-utensils"></i> Yeni Sipariş
                <span class="masa-badge">{{ $HangiMasa->masaadi }}</span>
            </div>
            <button class="back-btn" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i> Geri
            </button>
        </div>
        
        <div class="categories-section">
            <div class="categories-grid">
                <button class="category-btn active" data-category="all">
                    <i class="fas fa-th"></i> Tümü
                </button>
                @foreach($kategoriler as $kategori)
                    <button class="category-btn" data-category="{{ $kategori->id }}">
                        {{ $kategori->resim }} {{ $kategori->kategori_adi }}
                    </button>
                @endforeach
            </div>
        </div>
        
        <div class="products-section">
            <div class="products-grid" id="productsGrid"></div>
        </div>
    </div>
    
    <div class="quick-actions-panel">
        <button class="quick-btn success-btn">
            <i class="fas fa-search"></i>
            Ürün Ara
        </button>
        <button class="quick-btn danger-btn locked">
            <i class="fas fa-times-circle"></i>
            Masa İptal
        </button>
        <button class="quick-btn primary-btn locked">
            <i class="fas fa-link"></i>
            Masa Birleştir
        </button>
        <button class="quick-btn primary-btn locked">
            <i class="fas fa-arrows-alt"></i>
            Masa Taşı
        </button>
        <button class="quick-btn warning-btn locked">
            <i class="fas fa-cut"></i>
            Masa Ürün Böl
        </button>
        <button class="quick-btn info-btn locked">
            <i class="fas fa-gift"></i>
            İkram
        </button>
        <button class="quick-btn warning-btn">
            <i class="fas fa-sticky-note"></i>
            Not Ekle
        </button>
        <button class="quick-btn warning-btn">
            <i class="fas fa-print"></i>
            Adisyon Yazdır
        </button>
        <button class="quick-btn warning-btn locked">
            <i class="fas fa-receipt"></i>
            Adisyon Böl
        </button>
        <button class="quick-btn danger-btn">
            <i class="fas fa-trash"></i>
            Temizle
        </button>
    </div>

    <div class="order-panel">
        <div class="order-header">
            <h2><i class="fas fa-shopping-cart"></i> Sipariş Sepeti</h2>
        </div>
        
        <div class="order-items" id="orderItems">
            <div class="empty-order">
                <div class="empty-order-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div>Henüz ürün eklenmedi</div>
            </div>
        </div>
        
        <div class="order-summary" id="orderSummary" style="display: none;">
            <div class="summary-row">
                <span>Ara Toplam:</span>
                <span id="subtotal">0 ₺</span>
            </div>
            <div class="summary-row">
                <span>KDV:</span>
                <span id="tax">0 ₺</span>
            </div>
            <div class="summary-row total-row">
                <span>Toplam:</span>
                <span class="total-price" id="total">0 ₺</span>
            </div>
        </div>
        
        <div class="action-buttons">
            <button class="action-btn success-btn locked">
                <i class="fas fa-money-bill-wave"></i>
                <b>Nakit</b>
            </button>
            <button class="action-btn primary-btn locked">
                <i class="fas fa-credit-card"></i>
                <b>Kredi Kartı</b>
            </button>
            <button class="action-btn warning-btn">
                <i class="fas fa-paper-plane"></i>
                <b>Sipariş Ver</b>
            </button>
        </div>
    </div>
</div>

<script>
const products = [
    @foreach($urunler as $urun)
    {
        id: {{ $urun->id }},
        name: "{{ $urun->urunadi }}",
        price: {{ $urun->fiyat }},
        category: {{ $urun->kategori_id }},
        emoji: "{{ $urun->resim }}",
        restaurant_id: {{ $urun->restaurant_id }},
        kdv: {{ $urun->kategori->KDV }}
    },
    @endforeach
];

let currentCategory = 'all';
let orderItems = [];

document.addEventListener('DOMContentLoaded', function() {
    loadProducts();
    setupEventListeners();
});

function setupEventListeners() {
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentCategory = this.dataset.category;
            loadProducts();
        });
    });
}

function loadProducts() {
    const grid = document.getElementById('productsGrid');
    const filteredProducts = currentCategory === 'all' 
        ? products 
        : products.filter(p => p.category == currentCategory);
    
    grid.innerHTML = filteredProducts.map(product => `
        <div class="product-card" onclick="addToOrder(${product.id})">
            <div class="product-image">${product.emoji}</div>
            <div class="product-name">${product.name}</div>
            <div class="product-price">${product.price} ₺</div>
        </div>
    `).join('');
}

function addToOrder(productId) {
    const product = products.find(p => p.id === productId);
    const existingItem = orderItems.find(item => item.id === productId);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        orderItems.push({
            id: productId,
            name: product.name,
            price: product.price,
            quantity: 1
        });
    }
    
    updateOrderDisplay();
}

function updateOrderDisplay() {
    const orderItemsContainer = document.getElementById('orderItems');
    const orderSummary = document.getElementById('orderSummary');
    
    if (orderItems.length === 0) {
        orderItemsContainer.innerHTML = `
            <div class="empty-order">
                <div class="empty-order-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div>Henüz ürün eklenmedi</div>
            </div>
        `;
        orderSummary.style.display = 'none';
        return;
    }
    
    orderItemsContainer.innerHTML = orderItems.map(item => `
        <div class="order-item">
            <div class="item-header">
                <div class="item-name">${item.name}</div>
                <div class="item-price">${item.price} ₺</div>
            </div>
            <div class="item-controls">
                <div class="quantity-controls">
                    <button class="qty-btn" onclick="changeQuantity(${item.id}, -1)">-</button>
                    <span class="qty-value">${item.quantity}</span>
                    <button class="qty-btn" onclick="changeQuantity(${item.id}, 1)">+</button>
                </div>
                <button class="remove-btn" onclick="removeItem(${item.id})">Çıkar</button>
            </div>
        </div>
    `).join('');
    
    updateSummary();
    orderSummary.style.display = 'block';
}

function changeQuantity(productId, change) {
    const item = orderItems.find(item => item.id === productId);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            removeItem(productId);
        } else {
            updateOrderDisplay();
        }
    }
}

function removeItem(productId) {
    orderItems = orderItems.filter(item => item.id !== productId);
    updateOrderDisplay();
}

function updateSummary() {
    let subtotal = 0;
    let totalTax = 0;
    
    orderItems.forEach(item => {
        const product = products.find(p => p.id === item.id);
        const itemTotal = item.price * item.quantity;
        const itemTax = itemTotal * (product.kdv / 100);
        
        subtotal += itemTotal;
        totalTax += itemTax;
    });
    
    const total = subtotal + totalTax;
    
    document.getElementById('subtotal').textContent = subtotal.toFixed(2) + ' ₺';
    document.getElementById('tax').textContent = totalTax.toFixed(2) + ' ₺';
    document.getElementById('total').textContent = total.toFixed(2) + ' ₺';
}

const masaId = {{ $masaId }};

function unlockTable() {
    const formData = new FormData();
    formData.append('masaId', masaId);
    formData.append('_token', '{{ csrf_token() }}');
    
    navigator.sendBeacon('{{ route("unlockTable") }}', formData);
}

window.addEventListener('beforeunload', unlockTable);
window.addEventListener('popstate', function() {
    fetch('{{ route("unlockTable") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({masaId: masaId})
    });
});
window.addEventListener('pagehide', unlockTable);
document.addEventListener('visibilitychange', function() {
    if (document.visibilityState === 'hidden') {
        unlockTable();
    }
});
</script>
@endsection