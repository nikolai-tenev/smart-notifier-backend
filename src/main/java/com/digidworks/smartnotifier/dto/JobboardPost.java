package com.digidworks.smartnotifier.dto;

import lombok.Data;

@Data
public class JobboardPost {
	private String guid;
	private String title;
	private String link;
	private String description;
	private Long pubDate;
}
