const sidebar = document.querySelector('.sidebar');
const toggleBtn = document.getElementById('toggleBtn');
const mainContent = document.querySelector('.main-content');
// const logoIcon = document.getElementById('logoIcon'); // penting!

toggleBtn.addEventListener('click', () => {
  sidebar.classList.toggle('collapsed');

  if (sidebar.classList.contains('collapsed')) {
    logoIcon.classList.remove('fa-code');
    logoIcon.classList.add('fa-bars');
  } else {
    logoIcon.classList.remove('fa-bars');
    logoIcon.classList.add('fa-code');
  }
});

// // Fungsi buka-tutup submenu
//   const submenuLinks = document.querySelectorAll('.has-submenu > a');
//   submenuLinks.forEach(link => {
//     link.addEventListener('click', (e) => {
//       e.preventDefault();
//       const submenu = link.nextElementSibling;

//       // Tutup submenu lain (opsional)
//       document.querySelectorAll('.submenu').forEach(s => {
//         if (s !== submenu) s.classList.remove('show');
//       });

//       // Toggle tampilkan submenu ini
//       submenu.classList.toggle('show');
//     });
//   });

document.addEventListener("DOMContentLoaded", function () {
  const tahapBoxes = document.querySelectorAll(".tahap-box");

  tahapBoxes.forEach((box) => {
    const tambahBtn = box.querySelector(".tambah-soal");
    const resetBtn = box.querySelector(".reset-semua");
    const countEl = box.querySelector(".count");

    // pastikan ada .questions, kalau tidak buat
    let questions = box.querySelector(".questions");
    if (!questions) {
      questions = document.createElement("div");
      questions.classList.add("questions");
      // pindahkan .question awal ke .questions
      const firstQuestion = box.querySelector(".question");
      if (firstQuestion) {
        questions.appendChild(firstQuestion);
      }
      box.insertBefore(questions, tambahBtn);
    }

    updateCount();

    tambahBtn.addEventListener("click", () => {
      const newQuestion = questions.querySelector(".question").cloneNode(true);
      clearQuestion(newQuestion);
      questions.appendChild(newQuestion);
      attachHapus(newQuestion);
      updateCount();
    });

    resetBtn.addEventListener("click", () => {
      const allQuestions = questions.querySelectorAll(".question");
      allQuestions.forEach((q, i) => {
        if (i === 0) {
          clearQuestion(q);
        } else {
          q.remove();
        }
      });
      updateCount();
    });

    const allHapus = questions.querySelectorAll(".hapus-soal");
    allHapus.forEach(attachHapus);

    function attachHapus(button) {
      button.addEventListener("click", () => {
        const allQuestions = questions.querySelectorAll(".question");
        if (allQuestions.length > 1) {
          button.closest(".question").remove();
          updateCount();
        } else {
          alert("Minimal 1 soal harus ada.");
        }
      });
    }

    function clearQuestion(q) {
      q.querySelectorAll("input[type='text']").forEach((input) => (input.value = ""));
      q.querySelectorAll("input[type='file']").forEach((input) => (input.value = ""));
      const select = q.querySelector("select");
      if (select) select.selectedIndex = 0;
    }

    function updateCount() {
      const total = questions.querySelectorAll(".question").length;
      countEl.textContent = `${total} Soal`;
    }
  });

  document.getElementById("submit-all").addEventListener("click", () => {
    const data = {
      preTest: [],
      postTest: [],
    };

    tahapBoxes.forEach((box) => {
      const type = box.querySelector("h2").textContent.includes("Pre") ? "preTest" : "postTest";
      const questions = box.querySelectorAll(".question");

      questions.forEach((q) => {
        const soal = {
          pertanyaan: q.querySelector(".pertanyaan input[type='text']").value,
          gambarPertanyaan: q.querySelector(".pertanyaan input[type='file']").files[0]?.name || null,
          opsi: [],
          kunci: q.querySelector(".kunci-jawaban select").value,
        };

        const choices = q.querySelectorAll(".choice-row");
        choices.forEach((c) => {
          soal.opsi.push({
            teks: c.querySelector("input[type='text']").value,
            gambar: c.querySelector("input[type='file']").files[0]?.name || null,
          });
        });

        data[type].push(soal);
      });
    });

    console.log("Data semua soal:", data);
    alert("Data soal sudah dikumpulkan. Lihat console untuk detailnya.");
  });
});




// ==================================================//
document.addEventListener("DOMContentLoaded", () => {
  initAllTahap();
  initMateriTambahan();
});

function initAllTahap() {
  const tahapBoxes = document.querySelectorAll(".tahap-box");

  tahapBoxes.forEach(box => {
    const tambahBtn = box.querySelector(".tambah-soal");
    const resetBtn = box.querySelector(".reset-semua");

    if (tambahBtn) {
      tambahBtn.addEventListener("click", () => {
        const isTahap4PG = box.querySelector("h2").textContent.includes("Tahap 4") &&
                           box.querySelector(".choices");
        const lastQuestion = box.querySelector(".question:last-of-type");

        let newQuestion;
        if (isTahap4PG) {
          newQuestion = createPGQuestion();
        } else {
          newQuestion = lastQuestion.cloneNode(true);
          clearQuestion(newQuestion);
        }

        lastQuestion.after(newQuestion);
      });
    }

    if (resetBtn) {
      resetBtn.addEventListener("click", () => {
        const questions = box.querySelectorAll(".question");
        questions.forEach((q, i) => {
          if (i === 0) {
            clearQuestion(q);
          } else {
            q.remove();
          }
        });
      });
    }

    box.addEventListener("click", (e) => {
      if (!e.target.classList.contains("hapus-soal")) return;

      const question = e.target.closest(".question");
      const questions = box.querySelectorAll(".question");

      if (questions.length > 1) {
        question.remove();
      } else {
        clearQuestion(question);
      }
    });
  });
}

function clearQuestion(question) {
  question.querySelectorAll("input").forEach(input => {
    if (input.type === "file") {
      input.value = null;
    } else {
      input.value = "";
    }
  });
  question.querySelectorAll("select").forEach(select => {
    select.selectedIndex = 0;
  });
}

function createPGQuestion() {
  const div = document.createElement("div");
  div.classList.add("question");
  div.innerHTML = `
    <div class="pertanyaan">
      <input type="text" placeholder="Pertanyaan PG..." />
      <input type="file" accept="image/*" />
    </div>

    <div class="choices">
      ${['A','B','C','D','E'].map(opt => `
        <div class="choice-row">
          <input type="text" placeholder="Opsi ${opt}" />
          <input type="file" accept="image/*" />
        </div>
      `).join("")}
    </div>

    <div class="kunci-jawaban">
      <label>Pilih Kunci Jawaban:</label>
      <select>
        <option>A</option>
        <option>B</option>
        <option>C</option>
        <option>D</option>
        <option>E</option>
      </select>
    </div>

    <button type="button" class="hapus-soal">Hapus Soal</button>
  `;
  return div;
}

function initMateriTambahan() {
  const form = document.querySelector(".form-tambah");
  const list = document.querySelector(".daftar-materi");

  if (!form || !list) return;

  form.addEventListener("submit", e => {
    e.preventDefault();

    const judulInput = form.querySelector("input[type='text']");
    const fileInput = form.querySelector("input[type='file']");
    const judul = judulInput.value.trim();
    const file = fileInput.files[0];

    if (!judul || !file) {
      alert("Lengkapi judul & file.");
      return;
    }

    const li = document.createElement("li");
    li.innerHTML = `
      📄 ${judul} (${file.name})
      <button>Lihat</button>
      <button>Edit</button>
      <button class="hapus-materi">Hapus</button>
    `;
    list.appendChild(li);

    judulInput.value = "";
    fileInput.value = "";
  });

  list.addEventListener("click", e => {
    if (e.target.classList.contains("hapus-materi")) {
      e.target.closest("li").remove();
    }
  });
}


document.getElementById('inputForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('simpan_materi.php', {
        method: 'POST',
        body: formData
    }).then(response => response.text())
      .then(data => {
          alert("Data berhasil disimpan!");
          document.getElementById('myModal').style.display = 'none';
          this.reset(); // reset form
      }).catch(err => {
          alert("Gagal menyimpan: " + err);
      });
});
