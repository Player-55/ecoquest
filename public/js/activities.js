/* EcoQuest activities — plain JavaScript, no build step needed. */
(function () {
  'use strict';

  var section = document.getElementById('activity');
  var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // Tell the server the activity is finished (awards Eco Points once).
  function complete() {
    if (!section) return;
    fetch(section.dataset.url, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
      credentials: 'same-origin'
    })
      .then(function (r) { return r.json(); })
      .then(function (data) {
        section.classList.add('is-done');
        var msg = section.querySelector('.activity-msg');
        if (msg) {
          msg.textContent = data.awarded
            ? 'You earned +' + data.awarded + ' Eco Points.'
            : 'You already earned the points for this activity, but practice makes perfect!';
        }
        var nav = document.getElementById('nav-points');
        if (nav && data.points !== undefined) nav.textContent = data.points;
        var side = document.getElementById('side-activity');
        if (side) { side.textContent = 'Activity done'; side.className = 'tag tag-green'; }
      })
      .catch(function () { section.classList.add('is-done'); });
  }

  function shuffle(arr) {
    for (var i = arr.length - 1; i > 0; i--) {
      var j = Math.floor(Math.random() * (i + 1));
      var t = arr[i]; arr[i] = arr[j]; arr[j] = t;
    }
    return arr;
  }

  /* ---------- Myth or Fact (Level 1 content) ---------- */
  document.querySelectorAll('[data-mythfact] .mf-item').forEach(function (item) {
    item.querySelectorAll('[data-pick]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var right = btn.dataset.pick === item.dataset.answer;
        var fb = item.querySelector('.mf-feedback');
        fb.innerHTML = '<strong>' + (right ? 'Correct! ' : 'Not quite. ') + 'It is a ' + item.dataset.answer + '.</strong> ' + item.dataset.explain;
        fb.style.color = right ? 'var(--forest)' : 'var(--danger)';
      });
    });
  });

  /* ---------- Level 1: Cause & Effect chain ---------- */
  var chain = document.querySelector('[data-activity="chain"]');
  if (chain) {
    var pool = chain.querySelector('.chain-pool');
    var built = chain.querySelector('.chain-built');
    var feedback = chain.querySelector('.chain-feedback');
    var cards = shuffle(Array.prototype.slice.call(pool.children));
    cards.forEach(function (c) { pool.appendChild(c); });
    var next = 1;
    var total = cards.length;

    cards.forEach(function (card) {
      card.addEventListener('click', function () {
        if (card.classList.contains('placed')) return;
        if (Number(card.dataset.order) === next) {
          if (next > 1) {
            var arrow = document.createElement('li');
            arrow.className = 'chain-arrow';
            arrow.setAttribute('aria-hidden', 'true');
            arrow.textContent = '↓';
            built.appendChild(arrow);
          }
          var li = document.createElement('li');
          card.classList.add('placed');
          card.disabled = true;
          li.appendChild(card);
          built.appendChild(li);
          feedback.textContent = 'Correct! Step ' + next + ' of ' + total + '.';
          feedback.style.color = 'var(--forest)';
          next++;
          if (next > total) {
            feedback.textContent = 'You built the full chain: burning fossil fuels leads to more extreme weather.';
            complete();
          }
        } else {
          card.classList.remove('wrong');
          void card.offsetWidth;
          card.classList.add('wrong');
          var expected = pool.querySelector('[data-order="' + next + '"]');
          feedback.textContent = 'Not yet. Hint: ' + (expected ? expected.dataset.hint : '');
          feedback.style.color = 'var(--danger)';
        }
      });
    });
  }

  /* ---------- Level 2: Carbon footprint calculator ---------- */
  var calc = document.querySelector('[data-activity="calculator"]');
  if (calc) {
    var tips = {
      transport: 'Try walking, cycling, public transport or carpooling for your daily trips.',
      ac: 'Set the air-con to around 25°C, use a fan when you can, and switch it off when you leave.',
      food: 'Order only what you can finish and take leftovers home. Wasted food wastes all the energy used to make it.',
      plastic: 'Bring your own bottle, bag and container. Say no to straws you don\'t need.',
      shopping: 'Before buying, ask: do I really need it? Try borrowing, repairing or buying pre-loved.'
    };
    calc.addEventListener('submit', function (e) {
      e.preventDefault();
      var cats = ['transport', 'ac', 'food', 'plastic', 'shopping'];
      var scores = {};
      var missing = cats.filter(function (c) {
        var checked = calc.querySelector('input[name="' + c + '"]:checked');
        if (checked) scores[c] = Number(checked.value);
        return !checked;
      });
      var err = calc.querySelector('.calc-error');
      if (missing.length) { err.textContent = 'Please answer all five questions.'; return; }
      err.textContent = '';

      var sum = cats.reduce(function (a, c) { return a + scores[c]; }, 0); // 0..15
      var level = sum <= 4 ? 'Low' : (sum <= 9 ? 'Medium' : 'High');
      var result = calc.querySelector('.calc-result');
      result.classList.add('show');
      calc.querySelector('.needle').style.left = Math.round(sum / 15 * 100) + '%';
      calc.querySelector('.calc-title').textContent = 'Your footprint: ' + level + ' (' + sum + '/15)';
      calc.querySelector('.calc-text').textContent = level === 'Low'
        ? 'Excellent! Your daily habits already keep your footprint low. Keep it up and inspire your friends.'
        : level === 'Medium'
          ? 'Not bad, but there is room to improve. Focus on the tips below.'
          : 'Your habits create a large footprint. The good news: small changes make a big difference.';

      var ranked = cats.slice().sort(function (a, b) { return scores[b] - scores[a]; });
      var list = calc.querySelector('.calc-tips');
      list.innerHTML = '';
      ranked.slice(0, scores[ranked[0]] === 0 ? 1 : 3).forEach(function (c) {
        var li = document.createElement('li');
        li.textContent = tips[c];
        list.appendChild(li);
      });
      result.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      complete();
    });
  }

  /* ---------- Level 3: Sort the trash ---------- */
  var sort = document.querySelector('[data-activity="sort"]');
  if (sort) {
    var items = [
      { name: 'Old newspaper', bin: 'paper', why: 'Clean, dry paper can be recycled into new paper.' },
      { name: 'Empty cardboard box', bin: 'paper', why: 'Flatten cardboard and recycle it with paper.' },
      { name: 'Rinsed plastic water bottle', bin: 'plastic', why: 'Empty, rinsed plastic bottles are recyclable.' },
      { name: 'Empty aluminium drink can', bin: 'plastic', why: 'Metal cans go with plastics and metals, and aluminium can be recycled again and again.' },
      { name: 'Glass sauce bottle (rinsed)', bin: 'glass', why: 'Glass can be recycled, but keep it separate so it does not break into other materials.' },
      { name: 'Banana peel', bin: 'food', why: 'Fruit peels can be composted into fertiliser instead of rotting in a landfill.' },
      { name: 'Leftover rice', bin: 'food', why: 'Food waste can be composted. Better still, take only what you can finish!' },
      { name: 'Used tissue', bin: 'general', why: 'Used tissues are dirty and cannot be recycled, so they go to general waste.' },
      { name: 'Polystyrene box with curry stains', bin: 'general', why: 'Dirty food packaging usually cannot be recycled. Bring your own container next time!' },
      { name: 'Old notes printed on paper', bin: 'paper', why: 'Used paper can be recycled. Even better, print less.' }
    ];
    var binNames = { paper: 'Paper', plastic: 'Plastic & metal', glass: 'Glass', food: 'Food waste (compost)', general: 'General waste' };
    var order, idx, score, locked;
    var itemEl = sort.querySelector('.sort-item');
    var fb = sort.querySelector('.sort-feedback');
    var prog = sort.querySelector('.sort-progress');
    var scoreEl = sort.querySelector('.sort-score');
    var end = sort.querySelector('.sort-end');
    var bins = sort.querySelectorAll('.bin');

    function start() {
      order = shuffle(items.slice());
      idx = 0; score = 0; locked = false;
      end.hidden = true;
      bins.forEach(function (b) { b.disabled = false; });
      fb.textContent = '';
      show();
    }
    function show() {
      itemEl.textContent = order[idx].name;
      prog.textContent = 'Item ' + (idx + 1) + ' of ' + order.length;
      scoreEl.textContent = 'Score: ' + score;
    }
    bins.forEach(function (b) {
      b.addEventListener('click', function () {
        if (locked) return;
        locked = true;
        var it = order[idx];
        var right = b.dataset.bin === it.bin;
        if (right) score++;
        fb.innerHTML = '<strong>' + (right ? 'Correct! ' : 'Oops, that goes in ' + binNames[it.bin] + '. ') + '</strong>' + it.why;
        fb.style.color = right ? 'var(--forest)' : 'var(--danger)';
        scoreEl.textContent = 'Score: ' + score;
        setTimeout(function () {
          idx++;
          locked = false;
          if (idx >= order.length) {
            bins.forEach(function (x) { x.disabled = true; });
            itemEl.textContent = 'All sorted!';
            prog.textContent = 'Finished';
            end.hidden = false;
            sort.querySelector('.sort-final').textContent = 'You sorted ' + score + ' of ' + order.length + ' items correctly. ' +
              (score >= 8 ? 'Recycling pro!' : 'Read the feedback and try again to improve.');
            complete();
          } else {
            show();
          }
        }, 1400);
      });
    });
    sort.querySelector('.sort-again').addEventListener('click', start);
    start();
  }

  /* ---------- Level 4: Malaysia 2050 scenario ---------- */
  var sc = document.querySelector('[data-activity="scenario"]');
  if (sc) {
    var steps = sc.querySelectorAll('.scenario-step');
    var note = sc.querySelector('.scenario-note');
    var endBox = sc.querySelector('.scenario-end');
    var greenCount = 0, current = 0;

    function reset() {
      greenCount = 0; current = 0;
      steps.forEach(function (s, i) { s.classList.toggle('show', i === 0); });
      endBox.hidden = true;
      note.textContent = '';
    }
    steps.forEach(function (step) {
      step.querySelectorAll('.choice').forEach(function (btn) {
        btn.addEventListener('click', function () {
          if (btn.dataset.green === '1') greenCount++;
          note.textContent = btn.dataset.note;
          note.style.color = btn.dataset.green === '1' ? 'var(--forest)' : 'var(--danger)';
          step.classList.remove('show');
          current++;
          if (current < steps.length) {
            steps[current].classList.add('show');
          } else {
            var future = endBox.querySelector('.future');
            var green = greenCount >= 3;
            future.className = 'future ' + (green ? 'green' : 'grey');
            future.innerHTML = green
              ? '<h3>Malaysia 2050: a greener city</h3><p class="mb-0">You made ' + greenCount + ' of 4 green choices. Imagine millions of people making choices like yours: cleaner air, less waste in landfills and lower emissions, helping Malaysia reach net zero by 2050.</p>'
              : '<h3>Malaysia 2050: a hotter, greyer city</h3><p class="mb-0">You made ' + greenCount + ' of 4 green choices. If everyone made similar choices, emissions and waste would keep rising. The good news: every choice can be changed, so try again!</p>';
            endBox.hidden = false;
            complete();
          }
        });
      });
    });
    sc.querySelector('.scenario-again').addEventListener('click', reset);
  }
})();
