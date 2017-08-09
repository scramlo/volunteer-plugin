<?php if (basename($_SERVER['SCRIPT_NAME']) === 'index.php'): ?>
  <script src="scripts/<?= basename($_SERVER['SCRIPT_NAME'], '.php') ?>.js" charset="utf-8"></script>
  <script src="scripts/global.js" charset="utf-8"></script>
<?php else: ?>
  <script src="../scripts/<?= basename($_SERVER['SCRIPT_NAME'], '.php') ?>.js" charset="utf-8"></script>
  <script src="../scripts/global.js" charset="utf-8"></script>
<?php endif; ?>
</body>
</html>
