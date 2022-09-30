import { recurse } from 'cypress-recurse'
describe('Run CRUD on Books Table', () => {

  before(() => {
    cy.exec('php artisan migrate:fresh --seed');
    cy.exec('php artisan db:seed --class=userseeder');
  });

  beforeEach(() => {
    // Login As Admin
    cy.visit('/')

    cy.get('[data-id="login"]').should("have.text", "Login").should('be.visible');
    cy.get('[data-id="admin-button"]').should("have.text", "Admin").click({force: true});

    cy.get('[data-id="label-modal-admin"]').should("have.text", "Login Sebagai Admin");
    // menggunakan recurse karena ketika di run terjadi flake
    recurse(
      () => cy.get('[data-id="email_admin"]').clear().type("fauzanpr@gmail.com"),
      ($input) => $input.val() === "fauzanpr@gmail.com",
    )
    recurse(
      () => cy.get('[data-id="pass_admin"]').clear().type("123"),
      ($input) => $input.val() === "123",
    )
    cy.get('[data-id="login-button"]').click();
    
  })
  
  // it('Login As Admin', () => {
    
  // })

  // =============== CREATE ========================

  it('Create Book Data', () => {
    // ke menu kelola buku
    cy.visit('/kelolabuku');

    cy.get('[data-id="tambah-button"]').click();
    cy.get('[data-id="list-header"]').should("have.text", "List Data Buku");

    cy.get('[data-id="file-input"]').selectFile("cypress/e2e/cover.jpg")
    recurse(
      () => cy.get('[data-id="isbn"]').clear().type("9786024526986"),
      ($input) => $input.val() === "9786024526986",
    )
    recurse(
      () => cy.get('[data-id="judul"]').clear().type("Sebuah Seni Untuk Bersikap Bodo Amat"),
      ($input) => $input.val() === "Sebuah Seni Untuk Bersikap Bodo Amat",
    )
    recurse(
      () => cy.get('[data-id="pengarang"]').clear().type("Mark Manson"),
      ($input) => $input.val() === "Mark Manson",
    )
    recurse(
      () => cy.get('[data-id="penerbit"]').clear().type("PT. Gramedia"),
      ($input) => $input.val() === "PT. Gramedia",
    )
    recurse(
      () => cy.get('[data-id="harga"]').clear().type("80000"),
      ($input) => $input.val() === "80000",
    )
    recurse(
      () => cy.get('[data-id="stok"]').clear().type("10"),
      ($input) => $input.val() === "10",
    )
    cy.get('[data-id="kategori"]').select("novel")

    cy.get('[data-id="simpan-create"]').click();
  })

  // =============== READ ========================

  it('Read Book Data', () => {
    cy.visit('/kelolabuku');
  
    cy.get('[data-id="modal-detail"]').click();

    cy.get('[data-id="isbn-detail"]').should("have.text", "9786024526986");
    cy.get('[data-id="judul-detail"]').should("have.text", "Sebuah Seni Untuk Bersikap Bodo Amat");
    cy.get('[data-id="pengarang-detail"]').should("have.text", "Mark Manson");
    cy.get('[data-id="penerbit-detail"]').should("have.text", "PT. Gramedia");
    cy.get('[data-id="harga-detail"]').should("have.text", "80000");
    cy.get('[data-id="stok-detail"]').should("have.text", "10");
    cy.get('[data-id="kategori-detail"]').should("have.text", "novel");
  })

  // =============== EDIT ========================

  it('Edit Book Data', () => {
    cy.visit('/kelolabuku');
  
    cy.get('[data-id="modal-edit"]').click();

    cy.get('[data-id="file-edit"]').selectFile("cypress/e2e/cover_edit.jpg")
    recurse(
      () => cy.get('[data-id="isbn-edit"]').clear().type("9786021753545"),
      ($input) => $input.val() === "9786021753545",
    )
    recurse(
      () => cy.get('[data-id="judul-edit"]').clear().type("Budidaya Lele Di Lahan Sempit"),
      ($input) => $input.val() === "Budidaya Lele Di Lahan Sempit",
    )
    recurse(
      () => cy.get('[data-id="pengarang-edit"]').clear().type("Sri Rahayu"),
      ($input) => $input.val() === "Sri Rahayu",
    )
    recurse(
      () => cy.get('[data-id="penerbit-edit"]').clear().type("Infra Hijau"),
      ($input) => $input.val() === "Infra Hijau",
    )
    recurse(
      () => cy.get('[data-id="harga-edit"]').clear().type("30000"),
      ($input) => $input.val() === "30000",
    )
    recurse(
      () => cy.get('[data-id="stok-edit"]').clear().type("50"),
      ($input) => $input.val() === "50",
    )
    cy.get('[data-id="kategori-edit"]').select("pengetahuan")

    cy.get('[data-id="simpan-edit"]').click();
  })

  it('Edit Book Data without File', () => {
    cy.visit('/kelolabuku');
  
    cy.get('[data-id="modal-edit"]').click();

    recurse(
      () => cy.get('[data-id="isbn-edit"]').clear().type("9786024526986"),
      ($input) => $input.val() === "9786024526986",
    )
    recurse(
      () => cy.get('[data-id="judul-edit"]').clear().type("Sebuah Seni Untuk Bersikap Bodo Amat"),
      ($input) => $input.val() === "Sebuah Seni Untuk Bersikap Bodo Amat",
    )
    recurse(
      () => cy.get('[data-id="pengarang-edit"]').clear().type("Mark Manson"),
      ($input) => $input.val() === "Mark Manson",
    )
    recurse(
      () => cy.get('[data-id="penerbit-edit"]').clear().type("PT. Gramedia"),
      ($input) => $input.val() === "PT. Gramedia",
    )
    recurse(
      () => cy.get('[data-id="harga-edit"]').clear().type("80000"),
      ($input) => $input.val() === "80000",
    )
    recurse(
      () => cy.get('[data-id="stok-edit"]').clear().type("10"),
      ($input) => $input.val() === "10",
    )
    cy.get('[data-id="kategori-edit"]').select("novel")

    cy.get('[data-id="simpan-edit"]').click();
  })

  it('Edit Book Data isbn required', () => {
    cy.visit('/kelolabuku');
  
    cy.get('[data-id="modal-edit"]').click();

    cy.get('[data-id="file-edit"]').selectFile("cypress/e2e/cover_edit.jpg")
    recurse(
      () => cy.get('[data-id="isbn-edit"]').clear(),
      ($input) => $input.val() === "",
    )    
    
    recurse(
      () => cy.get('[data-id="judul-edit"]').clear().type("Budidaya Lele Di Lahan Sempit"),
      ($input) => $input.val() === "Budidaya Lele Di Lahan Sempit",
    )
    recurse(
      () => cy.get('[data-id="pengarang-edit"]').clear().type("Sri Rahayu"),
      ($input) => $input.val() === "Sri Rahayu",
    )
    recurse(
      () => cy.get('[data-id="penerbit-edit"]').clear().type("Infra Hijau"),
      ($input) => $input.val() === "Infra Hijau",
    )
    recurse(
      () => cy.get('[data-id="harga-edit"]').clear().type("30000"),
      ($input) => $input.val() === "30000",
    )
    recurse(
      () => cy.get('[data-id="stok-edit"]').clear().type("50"),
      ($input) => $input.val() === "50",
    )
    cy.get('[data-id="kategori-edit"]').select("pengetahuan")

    cy.get('[data-id="simpan-edit"]').click();

    cy.get('[data-id="isbn-edit"]').invoke('prop', 'validationMessage').should('equal', 'Isi bidang ini.')
  })

  it('Edit Book Data judul required', () => {
    cy.visit('/kelolabuku');
  
    cy.get('[data-id="modal-edit"]').click();

    cy.get('[data-id="file-edit"]').selectFile("cypress/e2e/cover_edit.jpg")
    recurse(
      () => cy.get('[data-id="isbn-edit"]').clear().type("9786021753545"),
      ($input) => $input.val() === "9786021753545",
    )    
    recurse(
      () => cy.get('[data-id="judul-edit"]').clear(),
      ($input) => $input.val() === "",
    )
    recurse(
      () => cy.get('[data-id="pengarang-edit"]').clear().type("Sri Rahayu"),
      ($input) => $input.val() === "Sri Rahayu",
    )
    recurse(
      () => cy.get('[data-id="penerbit-edit"]').clear().type("Infra Hijau"),
      ($input) => $input.val() === "Infra Hijau",
    )
    recurse(
      () => cy.get('[data-id="harga-edit"]').clear().type("30000"),
      ($input) => $input.val() === "30000",
    )
    recurse(
      () => cy.get('[data-id="stok-edit"]').clear().type("50"),
      ($input) => $input.val() === "50",
    )
    cy.get('[data-id="kategori-edit"]').select("pengetahuan")

    cy.get('[data-id="simpan-edit"]').click();

    cy.get('[data-id="judul-edit"]').invoke('prop', 'validationMessage').should('equal', 'Isi bidang ini.')
  })

  it('Edit Book Data pengarang required', () => {
    cy.visit('/kelolabuku');
  
    cy.get('[data-id="modal-edit"]').click();

    cy.get('[data-id="file-edit"]').selectFile("cypress/e2e/cover_edit.jpg")
    recurse(
      () => cy.get('[data-id="isbn-edit"]').clear().type("9786021753545"),
      ($input) => $input.val() === "9786021753545",
    )    
    recurse(
      () => cy.get('[data-id="judul-edit"]').clear().type("Budidaya Lele Di Lahan Sempit"),
      ($input) => $input.val() === "Budidaya Lele Di Lahan Sempit",
    )
    recurse(
      () => cy.get('[data-id="pengarang-edit"]').clear(),
      ($input) => $input.val() === "",
    )
    recurse(
      () => cy.get('[data-id="penerbit-edit"]').clear().type("Infra Hijau"),
      ($input) => $input.val() === "Infra Hijau",
    )
    recurse(
      () => cy.get('[data-id="harga-edit"]').clear().type("30000"),
      ($input) => $input.val() === "30000",
    )
    recurse(
      () => cy.get('[data-id="stok-edit"]').clear().type("50"),
      ($input) => $input.val() === "50",
    )
    cy.get('[data-id="kategori-edit"]').select("pengetahuan")

    cy.get('[data-id="simpan-edit"]').click();

    cy.get('[data-id="pengarang-edit"]').invoke('prop', 'validationMessage').should('equal', 'Isi bidang ini.')
  })

  it('Edit Book Data penerbit required', () => {
    cy.visit('/kelolabuku');
  
    cy.get('[data-id="modal-edit"]').click();

    cy.get('[data-id="file-edit"]').selectFile("cypress/e2e/cover_edit.jpg")
    recurse(
      () => cy.get('[data-id="isbn-edit"]').clear().type("9786021753545"),
      ($input) => $input.val() === "9786021753545",
    )    
    recurse(
      () => cy.get('[data-id="judul-edit"]').clear().type("Budidaya Lele Di Lahan Sempit"),
      ($input) => $input.val() === "Budidaya Lele Di Lahan Sempit",
    )
    recurse(
      () => cy.get('[data-id="pengarang-edit"]').clear().type("Sri Rahayu"),
      ($input) => $input.val() === "Sri Rahayu",
    )
    recurse(
      () => cy.get('[data-id="penerbit-edit"]').clear(),
      ($input) => $input.val() === "",
    )
    recurse(
      () => cy.get('[data-id="harga-edit"]').clear().type("30000"),
      ($input) => $input.val() === "30000",
    )
    recurse(
      () => cy.get('[data-id="stok-edit"]').clear().type("50"),
      ($input) => $input.val() === "50",
    )
    cy.get('[data-id="kategori-edit"]').select("pengetahuan")

    cy.get('[data-id="simpan-edit"]').click();

    cy.get('[data-id="penerbit-edit"]').invoke('prop', 'validationMessage').should('equal', 'Isi bidang ini.')
  })

  it('Edit Book Data harga required', () => {
    cy.visit('/kelolabuku');
  
    cy.get('[data-id="modal-edit"]').click();

    cy.get('[data-id="file-edit"]').selectFile("cypress/e2e/cover_edit.jpg")
    recurse(
      () => cy.get('[data-id="isbn-edit"]').clear().type("9786021753545"),
      ($input) => $input.val() === "9786021753545",
    )    
    recurse(
      () => cy.get('[data-id="judul-edit"]').clear().type("Budidaya Lele Di Lahan Sempit"),
      ($input) => $input.val() === "Budidaya Lele Di Lahan Sempit",
    )
    recurse(
      () => cy.get('[data-id="pengarang-edit"]').clear().type("Sri Rahayu"),
      ($input) => $input.val() === "Sri Rahayu",
    )
    recurse(
      () => cy.get('[data-id="penerbit-edit"]').clear().type("Infra Hijau"),
      ($input) => $input.val() === "Infra Hijau",
    )
    recurse(
      () => cy.get('[data-id="harga-edit"]').clear(),
      ($input) => $input.val() === "",
    )
    recurse(
      () => cy.get('[data-id="stok-edit"]').clear().type("50"),
      ($input) => $input.val() === "50",
    )
    cy.get('[data-id="kategori-edit"]').select("pengetahuan")

    cy.get('[data-id="simpan-edit"]').click();

    cy.get('[data-id="harga-edit"]').invoke('prop', 'validationMessage').should('equal', 'Isi bidang ini.')
  })

  it('Edit Book Data stok required', () => {
    cy.visit('/kelolabuku');
  
    cy.get('[data-id="modal-edit"]').click();

    cy.get('[data-id="file-edit"]').selectFile("cypress/e2e/cover_edit.jpg")
    recurse(
      () => cy.get('[data-id="isbn-edit"]').clear().type("9786021753545"),
      ($input) => $input.val() === "9786021753545",
    )    
    recurse(
      () => cy.get('[data-id="judul-edit"]').clear().type("Budidaya Lele Di Lahan Sempit"),
      ($input) => $input.val() === "Budidaya Lele Di Lahan Sempit",
    )
    recurse(
      () => cy.get('[data-id="pengarang-edit"]').clear().type("Sri Rahayu"),
      ($input) => $input.val() === "Sri Rahayu",
    )
    recurse(
      () => cy.get('[data-id="penerbit-edit"]').clear().type("Infra Hijau"),
      ($input) => $input.val() === "Infra Hijau",
    )
    recurse(
      () => cy.get('[data-id="harga-edit"]').clear().type("30000"),
      ($input) => $input.val() === "30000",
    )
    recurse(
      () => cy.get('[data-id="stok-edit"]').clear(),
      ($input) => $input.val() === "",
    )
    cy.get('[data-id="kategori-edit"]').select("pengetahuan")

    cy.get('[data-id="simpan-edit"]').click();

    cy.get('[data-id="stok-edit"]').invoke('prop', 'validationMessage').should('equal', 'Isi bidang ini.')
  })

  // =============== DELETE ========================

  it('Delete Book Data', () => {
    cy.visit('/kelolabuku');
  
    cy.get('[data-id="modal-delete"]').click();
  })
})

