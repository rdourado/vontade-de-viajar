install: configure

configure:

	@echo "⚙️ Configuring Wordpress parameters..."
	wp core install \
		--url="${WORDPRESS_WEBSITE_URL_WITHOUT_HTTP}" \
		--title="$(WORDPRESS_WEBSITE_TITLE)" \
		--admin_user="${WORDPRESS_ADMIN_USER}" \
		--admin_password="${WORDPRESS_ADMIN_PASSWORD}" \
		--admin_email="${WORDPRESS_ADMIN_EMAIL}"

	wp option update siteurl ${WORDPRESS_WEBSITE_URL}
	wp option update timezone_string "${WORDPRESS_TIMEZONE}"
	wp option update blogdescription "${WORDPRESS_WEBSITE_DESCRIPTION}"

	wp rewrite structure "${WORDPRESS_PERMALINKS_STRUCTURE}"

	wp plugin install ${PLUGINS_TO_INSTALL} --activate
	wp theme activate ${THEME_FOLDER}
	# wp import wp-content/themes/${THEME_FOLDER}/content.xml --authors=skip
